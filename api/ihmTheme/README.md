# Nadia - IHM Theme

`api/ihmTheme/${AppId}/` is the folder where the Theme is stored.

## Create your theme

### Variable:

#### HTML

1. *<!ThemeUrl>*: the url of the theme's folders.
    
    (ex: `https://exemple.com/api/ihmTheme/${AppId}/`)

    Useful for change a icone or other element of the page.

### File

**style.css**: style of the theme. It call in all page of the theme

**header.html**: header of the theme. It call in all page of the theme

:warning: **Not implemented**

**footer.html**: footer of the theme. It call in all page of the theme

## Page of the theme

This page is all page of the ihm who can be see by user

`Connection.php` (Account connection and creation page)

`aiguille/` (:warning: view only if your app have bad setup. It's a page for [Error](https://github.com/MisterMine01/ProjectNadia/tree/main/api/ihm/aiguille))

`connection/` (Page for accepted (or not) app connection)

`changePasswd/` (:warning: view only with admin app. It's a page for change the password)

`createApp/` (:warning: view only with admin app. It's a page for create a new app)

`createApp/createApp.php` (:warning: view only with admin app. It's a page for create a new app)