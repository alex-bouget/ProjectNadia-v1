SELECT G_Token,
    Username,
    A_Token
FROM Account
    INNER JOIN GRight on Account.R_Id = GRight.R_Id
WHERE G_Token = ?
    AND A_Token = ?
    AND UTC_TIMESTAMP <= A_Death
    AND GRight.Name != 'Banned'