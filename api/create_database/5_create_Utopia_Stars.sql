CREATE TABLE Stars(
   G_Token CHAR(15),
   S_Id CHAR(50),
   R_Id INT NOT NULL,
   PRIMARY KEY(G_Token, S_Id),
   FOREIGN KEY(G_Token) REFERENCES Gigly_Account(G_Token),
   FOREIGN KEY(S_Id) REFERENCES Utopia_Server(S_Id),
   FOREIGN KEY(R_Id) REFERENCES Gigly_Right(R_Id)
);