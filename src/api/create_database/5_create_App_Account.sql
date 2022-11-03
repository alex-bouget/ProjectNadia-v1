CREATE TABLE App_Account(
   A_Id VARCHAR(25) ,
   G_Token CHAR(15) ,
   A_Token CHAR(60) ,
   A_Death DATETIME,
   R_Id INT NOT NULL,
   PRIMARY KEY(A_Id, G_Token),
   UNIQUE(A_Token),
   FOREIGN KEY(A_Id) REFERENCES App(A_Id),
   FOREIGN KEY(G_Token) REFERENCES Account(G_Token),
   FOREIGN KEY(R_Id) REFERENCES GRight(R_Id)
);
