SELECT G_Token,
    Username,
    A_Token
FROM Account
    INNER JOIN GRight on Account.R_Id = GRight.R_Id
    INNER JOIN App_Account on Account.G_Token = App_Account.G_Token
WHERE Account.G_Token = ?
    AND A_Id = ?
    AND DATE('NOW') <= A_Death
    AND Gigly_Right.Name != 'Banned'