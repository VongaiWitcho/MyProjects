CREATE PROCEDURE Delete_Customer_Shadow1
    @CustomerID INT,
    @Name VARCHAR(100),
    @CustomerTyperID INT,
    @Email VARCHAR(255),
    @Phone VARCHAR(20),
    @Address VARCHAR(255),
	@CreatedAt datetime
AS
BEGIN
    INSERT INTO CustomersShadow (CustomerID, Name, CustomerTyperID, Email, Phone, Address, CreatedAt, ShadowOperation, ShadowTimeStamp)
    VALUES (@CustomerID, @Name, @CustomerTyperID, @Email, @Phone, @Address,@CreatedAt, 'DELETE', GETDATE());
END;
