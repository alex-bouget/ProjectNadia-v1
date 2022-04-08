SELECT G_Token, Username
FROM Account
WHERE LOWER(Username) LIKE LOWER(?)