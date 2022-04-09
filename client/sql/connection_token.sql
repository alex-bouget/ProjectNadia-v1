SELECT G_Token, Username, A_Token
FROM Account
    INNER JOIN GRight on Gigly_Account.R_Id = Gigly_Right.R_Id
WHERE G_Token = ? AND A_Token = ? AND DATE('NOW') <= A_Death AND Gigly_Right.Name != 'Banned'