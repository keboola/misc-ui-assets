# Misc UI Assets

[![Build Status](https://travis-ci.com/keboola/misc-ui-assets.svg?branch=master)](https://travis-ci.com/keboola/misc-ui-assets)

Assets definition and few helper scripts.

## Usage

- Modify `config.json` file
- Generate build script: `docker-compose run --rm -e DIST_VERSION=$(git describe --tags --always --long) php sh -c './build.php > build.sh'`
   - During development just pass `-e DIST_VERSION=dev` or something similar
- Check build script: `cat build.sh`
- Run build script: `docker-compose run --rm node sh -c 'cat build.sh | sh'`
- Check content of `dist` folder: `tree dist`
- Commit changes (usually changes to `config.json` and files in `src` folder)

### Deployment

Tagged commit in master branch will trigger deploy.

## Sample items

### Type `npm`

```json
{
  "id": "@keboola/indigo-ui",
  "version": "12.1.4",
  "type": "npm",
  "dir": "/node_modules/@keboola/indigo-ui/lib"
}
```

### Type `http`

*Note: Limited to one file.*

```json
{
  "id": "@microsoft/onedrive-file-picker",
  "version": "7.2.0",
  "type": "http",
  "url": "https://js.live.net/v7.2/OneDrive.js"
}
```
