SELECT App_Account.G_Token, App_Account.A_Token, Account.Username
FROM App_Account
    INNER JOIN Account On App_Account.G_Token = Account.G_Token
WHERE A_Id = ? AND App_Account.G_Token = ?