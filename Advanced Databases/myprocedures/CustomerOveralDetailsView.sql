USE [VongaiWitchoBank]
GO

/****** Object:  View [dbo].[CustomerOveralDetailsView]    Script Date: 2/15/2025 7:37:08 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE OR ALTER   VIEW [dbo].[CustomerOveralDetailsView] AS
SELECT 
    c.ID, 
    c.Name,
	c.Email,
	c.Phone,
	c.Address,
	c.CreatedAt,
    ct.TypeName, 
    bp.ProductName, 
    i.InsuranceType, 
    i.CoverageAmount
FROM Customers c
JOIN CustomerType ct ON c.CustomerTypeID = ct.ID
JOIN CustomerProducts cp ON c.ID = cp.ID  
JOIN BankingProducts bp ON cp.ID = bp.ID    
JOIN Insurance i ON c.ID = i.CustomerID;      
GO


