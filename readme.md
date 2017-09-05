# Misc UI Assets

[![Build Status](https://travis-ci.org/keboola/misc-ui-assets.svg?branch=master)](https://travis-ci.org/keboola/misc-ui-assets)

Assets definition and few helper scripts.

## Usage

1. Modify `config.json` file
2. Generate build script `docker-compose run --rm php sh -c './build.php > build.sh'`
3. Check build script (`cat build.sh`)
4. Run build script `docker-compose run --rm node sh -c 'cat build.sh | sh'`
5. Commit changes
