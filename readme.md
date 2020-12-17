# Misc UI Assets

[![Build Status](https://travis-ci.com/keboola/misc-ui-assets.svg?branch=master)](https://travis-ci.com/keboola/misc-ui-assets)

Assets definition and few helper scripts.

## Usage

1. Modify `config.json` file
2. Generate build script `docker-compose run --rm php sh -c './build.php > build.sh'`
3. Check build script (`cat build.sh`)
4. Run build script `docker-compose run --rm node sh -c 'cat build.sh | sh'`
5. Commit changes

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
