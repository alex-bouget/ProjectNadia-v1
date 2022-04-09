SELECT G_Token, Username
FROM Account
    INNER JOIN App_Account on Account.G_Token = App_Account.G_Token
WHERE A_Id = ? LOWER(Username) LIKE LOWER(?)