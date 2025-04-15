ALTER TABLE [dbo].[Security]  
ADD CONSTRAINT FK_Security_Customers 
FOREIGN KEY (CustomerID) 
REFERENCES [dbo].[Customers] (ID) 
ON DELETE SET NULL;
