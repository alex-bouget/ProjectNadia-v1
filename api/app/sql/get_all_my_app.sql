SELECT A_Id,
    Name,
    Description
FROM App
WHERE ? IN (
        SELECT G_Token
        FROM App_Account
        WHERE App_Account.A_Id = App.A_Id
            AND App_Account.R_Id IN (
                SELECT R_Id
                FROM GRight
                WHERE GRight.Name IN (
                        'Admin',
                        'Moderator'
                    )
            )
    );