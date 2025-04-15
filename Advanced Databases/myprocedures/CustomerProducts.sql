CREATE VIEW CustomerProducts AS
SELECT c.CustomerID, c.Name, ct.TypeName, bp.ProductName
FROM Customers c
JOIN CustomerType ct ON c.CustomerTypeID = ct.CustomerTypeID
JOIN BankingProducts bp ON c.CustomerID = bp.ProductID;
