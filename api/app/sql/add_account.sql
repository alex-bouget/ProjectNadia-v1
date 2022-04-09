INSERT INTO App_Account (A_Id, G_Token, A_Token, A_Death, R_Id)
VALUES (?, ?, ?, ?, (SELECT R_Id from GRight WHERE Name = ?))