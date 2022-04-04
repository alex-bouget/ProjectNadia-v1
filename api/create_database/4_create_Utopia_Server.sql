CREATE TABLE Utopia_Server(
   S_Id CHAR(50) ,
   Name VARCHAR(50)  NOT NULL,
   Url VARCHAR(150)  NOT NULL,
   V_Id INT NOT NULL,
   G_Token CHAR(15)  NOT NULL,
   PRIMARY KEY(S_Id),
   UNIQUE(Url),
   FOREIGN KEY(V_Id) REFERENCES Utopia_Visibility(V_Id),
   FOREIGN KEY(G_Token) REFERENCES Gigly_Account(G_Token)
);
