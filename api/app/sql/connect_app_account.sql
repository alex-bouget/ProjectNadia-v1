SELECT Account.G_Token,
    Username,
    App_Account.A_Token as 'App_A_Token',
    Account.A_Token as 'A_Token'
FROM Account
    INNER JOIN GRight on Account.R_Id = GRight.R_Id
    INNER JOIN App_Account on Account.G_Token = App_Account.G_Token
WHERE Account.G_Token = ?
    AND A_Id = ?
    AND App_Account.A_Token = ?
    AND DATE('NOW') <= App_Account.A_Death
    AND GRight.Name != 'Banned'