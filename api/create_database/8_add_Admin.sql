INSERT INTO Gigly_Account (
        G_Token,
        Username,
        Password,
        A_Token,
        A_Death,
        R_Id
    )
VALUES (
        'AdminFirstRoot1',
        'GiglyAdmin',
        ?,
        '',
        '',
        (
            select R_Id
            from Gigly_Right
            where Name = 'Admin'
        )
    )