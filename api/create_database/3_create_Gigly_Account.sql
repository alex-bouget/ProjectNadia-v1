CREATE TABLE Gigly_Account(
    G_Token CHAR(15),
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    A_Token CHAR(60) NOT NULL,
    A_Death DATE NOT NULL,
    R_Id INT NOT NULL,
    PRIMARY KEY(G_Token),
    UNIQUE(Username),
    UNIQUE(A_Token),
    FOREIGN KEY(R_Id) REFERENCES Gigly_Right(R_Id)
);