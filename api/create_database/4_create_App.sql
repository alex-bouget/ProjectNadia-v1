CREATE TABLE App(
   A_Id CHAR(25) ,
   Secret_Key CHAR(70)  NOT NULL,
   Name VARCHAR(50)  NOT NULL,
   Description VARCHAR(200) ,
   G_Token CHAR(15)  NOT NULL,
   PRIMARY KEY(A_Id),
   UNIQUE(Secret_Key),
   FOREIGN KEY(G_Token) REFERENCES Account(G_Token)
);
