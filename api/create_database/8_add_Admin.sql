INSERT INTO Account (
        G_Token,
        Username,
        Password,
        A_Token,
        A_Death,
        R_Id
    )
VALUES (
        'AdminFirstRoot1',
        'NadiaAdmin',
        ?,
        'kopsriovezvu',
        DATE_ADD(NOW(), INTERVAL 1 DAY),
        (
            select R_Id
            from GRight
            where Name = 'Admin'
        )
    )