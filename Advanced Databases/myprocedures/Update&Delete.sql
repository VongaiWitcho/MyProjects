USE [VongaiWitchoBank]
GO

/****** Object:  StoredProcedure [dbo].[Delete_Customer_Shadow1]    Script Date: 2/15/2025 3:25:16 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE OR ALTER PROCEDURE [dbo].[Delete_Customer_Shadow]
	@ID INT
AS
BEGIN

    INSERT INTO CustomersShadow (ShadowOperation, ShadowTimeStamp, ID, Name, CustomerTypeID, Email, Phone, Address, CreatedAt)
	SELECT 'D', GETDATE(), ID, Name, CustomerTypeID, Email, Phone, Address, CreatedAt FROM Customers
	WHERE ID= @ID;

	DELETE FROM Customers
	WHERE ID = @ID;

END;
GO

USE [VongaiWitchoBank]
GO

/****** Object:  StoredProcedure [dbo].[UPDATE_Customer_Shadow2]    Script Date: 2/15/2025 3:09:27 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE OR ALTER PROCEDURE [dbo].[Update_Customer_Shadow]
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





