USE [VongaiWitchoBank]
GO

/****** Object:  StoredProcedure [dbo].[Update_Customer_Shadow]    Script Date: 2/15/2025 7:04:01 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE OR ALTER   PROCEDURE [dbo].[Update_Customer_Shadow]
    @Name VARCHAR(100),
    @CustomerTypeID INT,
    @Email VARCHAR(255),
    @Phone VARCHAR(20),
    @Address VARCHAR(255),
	@CreatedAt datetime,
	@ID INT
AS
BEGIN
    INSERT INTO CustomersShadow (ShadowOperation, ShadowTimeStamp, ID, Name, CustomerTypeID, Email, Phone, Address, CreatedAt)
	SELECT 'U', GETDATE(), ID, Name, CustomerTypeID, Email, Phone, Address, CreatedAt FROM Customers
	 WHERE ID= @ID;

     UPDATE Customers
	 SET
	    Name = @Name,
		CustomerTypeID = @CustomerTypeID,
		Email = @Email,
		Phone = @Phone,
		Address = @Address,
		CreatedAt = @CreatedAt
	 WHERE ID = @ID;
END;
GO

