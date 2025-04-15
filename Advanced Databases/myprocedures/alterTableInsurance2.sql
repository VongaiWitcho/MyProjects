ALTER TABLE Insurance DROP CONSTRAINT FK_Insurance_Customers;

ALTER TABLE Insurance 
ADD CONSTRAINT FK_Insurance_Customers 
FOREIGN KEY (CustomerID) REFERENCES Customers (ID) ON DELETE SET NULL;
