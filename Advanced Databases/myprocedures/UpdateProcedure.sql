CREATE PROCEDURE UpdateCustomer
    @CustomerID INT,
    @Name NVARCHAR(255),
    @Email NVARCHAR(255),
    @Phone NVARCHAR(50),
    @Address NVARCHAR(255)
AS
BEGIN
    UPDATE Customers
    SET Name = @Name, Email = @Email, Phone = @Phone, Address = @Address
    WHERE CustomerID = @CustomerID;
END;
