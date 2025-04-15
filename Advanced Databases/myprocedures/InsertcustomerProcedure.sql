CREATE PROCEDURE InsertCustomer
    @Name NVARCHAR(255),
    @CustomerTypeID INT,
    @Email NVARCHAR(255),
    @Phone NVARCHAR(50),
    @Address NVARCHAR(255)
AS
BEGIN
    INSERT INTO Customers (Name, CustomerTypeID, Email, Phone, Address)
    VALUES (@Name, @CustomerTypeID, @Email, @Phone, @Address);
END;
