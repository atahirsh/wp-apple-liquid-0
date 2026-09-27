#!/usr/bin/env bash
#
# Build a WordPress-installable theme zip (liquid-glass.zip) from this repo.
#
# The zip contains a single top-level folder `liquid-glass/` with only the
# theme files, exactly as required by wp-admin:
#   Appearance -> Themes -> Add New -> Upload Theme
#
# Usage:  ./bin/build-zip.sh [output.zip]
#
set -euo pipefail

repo_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
out="${1:-${repo_root}/liquid-glass.zip}"
theme_slug="liquid-glass"

staging="$(mktemp -d)"
trap 'rm -rf "${staging}"' EXIT

if command -v git >/dev/null 2>&1 && [ -d "${repo_root}/.git" ]; then
	# Deterministic export: tracked files only, honoring .gitattributes export-ignore.
	git -C "${repo_root}" archive --prefix="${theme_slug}/" --format=tar HEAD | tar -x -C "${staging}"
else
	# Fallback for a plain source download (no .git): copy and strip dev-only files.
	mkdir -p "${staging}/${theme_slug}"
	cp -R "${repo_root}/." "${staging}/${theme_slug}/"
	rm -rf "${staging}/${theme_slug}/.git" \
	       "${staging}/${theme_slug}/.github" \
	       "${staging}/${theme_slug}/bin" \
	       "${staging}/${theme_slug}/.gitattributes"
fi

# Sanity check: this is what WordPress requires to recognize a theme.
test -f "${staging}/${theme_slug}/style.css" || { echo "ERROR: style.css missing"; exit 1; }
grep -q "^Theme Name:" "${staging}/${theme_slug}/style.css" || { echo "ERROR: theme header missing in style.css"; exit 1; }
test -f "${staging}/${theme_slug}/index.php" || { echo "ERROR: index.php missing"; exit 1; }

rm -f "${out}"
if command -v zip >/dev/null 2>&1; then
	( cd "${staging}" && zip -rq "${out}" "${theme_slug}" -x "*/.DS_Store" )
elif command -v python3 >/dev/null 2>&1; then
	python3 - "$staging" "$theme_slug" "$out" <<'PY'
import os, sys, zipfile
staging, slug, out = sys.argv[1:4]
with zipfile.ZipFile(out, "w", zipfile.ZIP_DEFLATED) as zf:
    for root, dirs, files in os.walk(os.path.join(staging, slug)):
        dirs[:] = [d for d in dirs if d not in (".git", ".DS_Store")]
        for f in sorted(files):
            if f == ".DS_Store":
                continue
            full = os.path.join(root, f)
            zf.write(full, os.path.relpath(full, staging))
PY
else
	echo "ERROR: need either 'zip' or 'python3' to build the archive." >&2
	exit 1
fi

echo "Built ${out}:"
unzip -l "${out}" 2>/dev/null | tail -n 3 || python3 -c "import zipfile,sys; print('\n'.join(zipfile.ZipFile(sys.argv[1]).namelist()[:5]), '...')" "${out}"
