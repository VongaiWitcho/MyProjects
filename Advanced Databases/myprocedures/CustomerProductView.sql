CREATE VIEW CustomerProductsView AS
SELECT 
    c.CustomerID, 
    c.Name, 
    ct.TypeName, 
    bp.ProductName
FROM Customers c
JOIN CustomerType ct ON c.CustomerTypeID = ct.CustomerTypeID
JOIN CustomerProducts cp ON c.CustomerID = cp.CustomerID  
JOIN BankingProducts bp ON cp.ProductID = bp.ProductID;   
