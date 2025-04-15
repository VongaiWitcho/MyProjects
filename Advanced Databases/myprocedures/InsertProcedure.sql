USE [VongaiWitchoBank]
GO

/****** Object:  StoredProcedure [dbo].[InsertCustomer]    Script Date: 2/15/2025 8:03:58 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE OR ALTER   PROCEDURE [dbo].[InsertCustomer]
    @Name NVARCHAR(255),
    @CustomerTypeID INT,
    @Email NVARCHAR(255),
    @Phone NVARCHAR(50),
    @Address NVARCHAR(255),
	@ID int output
AS
BEGIN
    INSERT INTO Customers (Name, CustomerTypeID, Email, Phone, Address)
    VALUES (@Name, @CustomerTypeID, @Email, @Phone, @Address);
	SET @ID = @@IDENTITY;
END;
GO



