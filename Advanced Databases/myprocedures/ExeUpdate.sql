EXEC Update_Customer_Shadow 
    @ID = 3,
	@Name = 'Sandra',
    @Email = 'jnjnk@example.com',
	@CustomerTypeID = 2, 
	@CreatedAt = '1982-11-20',
	@Address = '52 Rosebud',
    @Phone = '987654321';
SELECT *FROM CustomersShadow