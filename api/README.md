# Nadia-API

### All purpose

#### Connect to your account

Connect to the API for get a account for you app.

`GET ihm/?APPID=<APPID>&tempToken=<tempToken>&URI=<URI>&Purpose=Connection`

#### PasswordChange

Change the password of a account.

`GET ihm/?APPID=<APPID>&tempToken=<tempToken>&URI=<URI>&Purpose=PasswordChange`

:warning: **Warning**: This Purpose need adminApp

#### AllMyApp

`GET ihm/?APPID=<APPID>&tempToken=<tempToken>&URI=<URI>&Purpose=AllMyApp`

Not implemented yet.
#### CreateApp

`GET ihm/?APPID=<APPID>&tempToken=<tempToken>&URI=<URI>&Purpose=AllMyApp`

:warning: **Warning**: This Purpose need adminApp

#### PasswordReset

`GET ihm/?APPID=<APPID>&tempToken=<tempToken>&URI=<URI>&Purpose=AllMyApp`

Not implemented yet.

### All Errors:

Show to the user:

- *N-001* - Purpose is not defined
- *N-002* - Purpose is not valid
- *N-003* - Purpose is not supported

Return in the URI:
```json
{"Error": "tempToken not valid"}
```
```json
{"Error": "User not want you"}
```
```json
{"Error": "App not have the right"}
```