USE [master]
GO
/****** Object:  Database [VongaiWitchoBank]    Script Date: 2/15/2025 8:09:05 PM ******/
CREATE DATABASE [VongaiWitchoBank]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'VongaiWitchoBank', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLEXPRESS\MSSQL\DATA\VongaiWitchoBank.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'VongaiWitchoBank_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLEXPRESS\MSSQL\DATA\VongaiWitchoBank_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [VongaiWitchoBank] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [VongaiWitchoBank].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [VongaiWitchoBank] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET ARITHABORT OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [VongaiWitchoBank] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [VongaiWitchoBank] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET  DISABLE_BROKER 
GO
ALTER DATABASE [VongaiWitchoBank] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [VongaiWitchoBank] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [VongaiWitchoBank] SET  MULTI_USER 
GO
ALTER DATABASE [VongaiWitchoBank] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [VongaiWitchoBank] SET DB_CHAINING OFF 
GO
ALTER DATABASE [VongaiWitchoBank] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [VongaiWitchoBank] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [VongaiWitchoBank] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [VongaiWitchoBank] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [VongaiWitchoBank] SET QUERY_STORE = ON
GO
ALTER DATABASE [VongaiWitchoBank] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [VongaiWitchoBank]
GO
/****** Object:  Table [dbo].[Customers]    Script Date: 2/15/2025 8:09:05 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Customers](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](255) NULL,
	[CustomerTypeID] [int] NULL,
	[Email] [nvarchar](255) NULL,
	[Phone] [nvarchar](50) NULL,
	[Address] [nvarchar](255) NULL,
	[CreatedAt] [datetime] NULL,
 CONSTRAINT [PK_Customers] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[BankingProducts]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[BankingProducts](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[ProductName] [nvarchar](100) NULL,
	[ProductType] [nvarchar](50) NULL,
 CONSTRAINT [PK_BankingProducts] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Insurance]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Insurance](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[CustomerID] [int] NULL,
	[InsuranceType] [nvarchar](100) NULL,
	[CoverageAmount] [decimal](10, 2) NULL,
	[ExpiryDate] [date] NULL,
 CONSTRAINT [PK_Insurance] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CustomerType]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CustomerType](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[TypeName] [nvarchar](50) NULL,
 CONSTRAINT [PK_CustomerType] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CustomerProducts]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CustomerProducts](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[CustomerID] [int] NOT NULL,
	[ProductID] [int] NOT NULL,
 CONSTRAINT [PK_CustomerProducts] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  View [dbo].[CustomerOveralDetailsView]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE     VIEW [dbo].[CustomerOveralDetailsView] AS
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
/****** Object:  Table [dbo].[CustomersShadow]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CustomersShadow](
	[ShadowID] [int] IDENTITY(1,1) NOT NULL,
	[ShadowOperation] [nvarchar](50) NULL,
	[ShadowTimeStamp] [datetime2](7) NULL,
	[ID] [int] NULL,
	[Name] [nvarchar](255) NULL,
	[CustomerTypeID] [int] NULL,
	[Email] [nvarchar](255) NULL,
	[Phone] [nvarchar](50) NULL,
	[Address] [nvarchar](255) NULL,
	[CreatedAt] [datetime] NULL,
 CONSTRAINT [PK_CustomersShadow] PRIMARY KEY CLUSTERED 
(
	[ShadowID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Locations]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Locations](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[BranchName] [nvarchar](255) NULL,
	[Address] [nvarchar](255) NULL,
 CONSTRAINT [PK_Locations] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Security]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Security](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[CustomerID] [int] NULL,
	[PasswordHash] [nvarchar](255) NULL,
	[LastLogin] [datetime] NULL,
 CONSTRAINT [PK_Security] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[BankingProducts] ON 
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (1, N'Savings Account', N'Deposit Account')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (2, N'Current Account', N'Deposit Account')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (3, N'Fixed Deposit (FD)', N'Deposit Account')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (4, N'Home Loan (Mortgage)', N'Credit Product')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (5, N'Personal Loan', N'Credit Product')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (6, N'Auto Loan', N'Credit Product')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (7, N'Mutual Funds', N'Investment Product')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (8, N'Stocks & Bonds', N'Investment Product')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (9, N'Pension Fund', N'Investment Product')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (10, N'Life Insurance', N'Insurance')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (11, N'Health Insurance', N'Insurance')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (12, N'Car Insurance', N'Insurance')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (13, N'Mobile Banking App', N'Digital Service')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (14, N'Internet Banking', N'Digital Service')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (15, N'UPI Payments', N'Digital Service')
GO
INSERT [dbo].[BankingProducts] ([ID], [ProductName], [ProductType]) VALUES (16, N'International Wire Transfer', N'Digital Service')
GO
SET IDENTITY_INSERT [dbo].[BankingProducts] OFF
GO
SET IDENTITY_INSERT [dbo].[CustomerProducts] ON 
GO
INSERT [dbo].[CustomerProducts] ([ID], [CustomerID], [ProductID]) VALUES (1, 1, 2)
GO
INSERT [dbo].[CustomerProducts] ([ID], [CustomerID], [ProductID]) VALUES (2, 2, 3)
GO
INSERT [dbo].[CustomerProducts] ([ID], [CustomerID], [ProductID]) VALUES (3, 3, 1)
GO
SET IDENTITY_INSERT [dbo].[CustomerProducts] OFF
GO
SET IDENTITY_INSERT [dbo].[Customers] ON 
GO
INSERT [dbo].[Customers] ([ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1, N'John Smith', 1, N'john.smith@email.com', N'+48 601234567', N'123 Main Street', CAST(N'1985-07-22T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[Customers] ([ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (2, N'Anna Kowalska', 1, N'anna.kowalska@email.com', N'+48 609876543', N'45 Green Ave', CAST(N'1990-12-15T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[Customers] ([ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (3, N'Sandra', 2, N'jnjnk@example.com', N'987654321', N'52 Rosebud', CAST(N'1982-11-20T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[Customers] ([ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (4, N'Samson', 2, N'newemail@example.com', N'987654321', N'52 Rosebud', CAST(N'1982-11-20T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[Customers] ([ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (6, N'Emily Hassan', 1, N'emily.j@email.com', N'+1 555678123', N'Czarna Droga 54', CAST(N'1995-04-11T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[Customers] ([ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (7, N'Ahmed Hassan', 1, N'ahmed.h@email.com', N'+20 102334455', N'77 Silin Val', CAST(N'1982-11-20T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[Customers] ([ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (8, N'Tesla Inc.', 2, N'finance@tesla.com', N'+49 173456789', N'32 Berlin Platz', CAST(N'2003-05-28T00:00:00.000' AS DateTime))
GO
SET IDENTITY_INSERT [dbo].[Customers] OFF
GO
SET IDENTITY_INSERT [dbo].[CustomersShadow] ON 
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (12, N'D', CAST(N'2025-02-13T23:31:52.5733333' AS DateTime2), 5, N'TechCorp', 2, N'info@techcorp.com', N'+44 792233445', N'77 Silicon Valley', CAST(N'2012-03-18T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1013, N'D', CAST(N'2025-02-15T15:39:10.8566667' AS DateTime2), 5, N'TechCorp', 2, N'info@techcorp.com', N'+44 792233445', N'77 Silicon Valley', CAST(N'2012-03-18T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1014, N'D', CAST(N'2025-02-15T18:40:16.6533333' AS DateTime2), 5, N'TechCorp', 2, N'info@techcorp.com', N'+44 792233445', N'77 Silicon Valley', CAST(N'2012-03-18T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1015, N'D', CAST(N'2025-02-15T18:44:01.7833333' AS DateTime2), 5, N'TechCorp', 2, N'info@techcorp.com', N'+44 792233445', N'77 Silicon Valley', CAST(N'2012-03-18T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1016, N'U', CAST(N'2025-02-15T18:58:55.8166667' AS DateTime2), 4, N'Carlos Rodríguez', 1, N'carlos.rod@email.com', N'+34 612345678', N'56 Madrid', CAST(N'1978-09-05T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1017, N'U', CAST(N'2025-02-15T19:02:06.6200000' AS DateTime2), 4, N'Samson', 1, N'newemail@example.com', N'987654321', N'52 Rosebud', CAST(N'1982-11-20T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1018, N'U', CAST(N'2025-02-15T19:08:57.0600000' AS DateTime2), 4, N'Samson', 2, N'newemail@example.com', N'987654321', N'52 Rosebud', CAST(N'1982-11-20T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1019, N'Updated', CAST(N'2025-02-15T19:08:57.0733333' AS DateTime2), 4, N'Samson', 2, N'newemail@example.com', N'987654321', N'52 Rosebud', CAST(N'1982-11-20T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1020, N'U', CAST(N'2025-02-15T19:09:51.9300000' AS DateTime2), 3, N'XYZ Ltd.', 2, N'contact@xyzltd.com', N'+48 602112233', N'88 Corporate Tower', CAST(N'2005-06-10T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1021, N'U', CAST(N'2025-02-15T19:09:51.9333333' AS DateTime2), 3, N'amso', 2, N'jnjnk@example.com', N'987654321', N'52 Rosebud', CAST(N'1982-11-20T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[CustomersShadow] ([ShadowID], [ShadowOperation], [ShadowTimeStamp], [ID], [Name], [CustomerTypeID], [Email], [Phone], [Address], [CreatedAt]) VALUES (1022, N'U', CAST(N'2025-02-15T19:14:29.0033333' AS DateTime2), 3, N'amso', 2, N'jnjnk@example.com', N'987654321', N'52 Rosebud', CAST(N'1982-11-20T00:00:00.000' AS DateTime))
GO
SET IDENTITY_INSERT [dbo].[CustomersShadow] OFF
GO
SET IDENTITY_INSERT [dbo].[CustomerType] ON 
GO
INSERT [dbo].[CustomerType] ([ID], [TypeName]) VALUES (1, N'Person')
GO
INSERT [dbo].[CustomerType] ([ID], [TypeName]) VALUES (2, N'Compnay')
GO
SET IDENTITY_INSERT [dbo].[CustomerType] OFF
GO
SET IDENTITY_INSERT [dbo].[Insurance] ON 
GO
INSERT [dbo].[Insurance] ([ID], [CustomerID], [InsuranceType], [CoverageAmount], [ExpiryDate]) VALUES (1, 3, N'Life Insurance', CAST(200.00 AS Decimal(10, 2)), CAST(N'2025-02-02' AS Date))
GO
INSERT [dbo].[Insurance] ([ID], [CustomerID], [InsuranceType], [CoverageAmount], [ExpiryDate]) VALUES (2, 2, N'Health Insurance', CAST(120.99 AS Decimal(10, 2)), CAST(N'2025-03-15' AS Date))
GO
INSERT [dbo].[Insurance] ([ID], [CustomerID], [InsuranceType], [CoverageAmount], [ExpiryDate]) VALUES (3, 4, N'Car Insurance', CAST(33.43 AS Decimal(10, 2)), CAST(N'2025-12-15' AS Date))
GO
INSERT [dbo].[Insurance] ([ID], [CustomerID], [InsuranceType], [CoverageAmount], [ExpiryDate]) VALUES (4, 1, N'Travel Insurance', CAST(50.45 AS Decimal(10, 2)), CAST(N'2025-06-09' AS Date))
GO
INSERT [dbo].[Insurance] ([ID], [CustomerID], [InsuranceType], [CoverageAmount], [ExpiryDate]) VALUES (5, NULL, N'Travel Insurance', CAST(201.00 AS Decimal(10, 2)), CAST(N'2026-11-19' AS Date))
GO
INSERT [dbo].[Insurance] ([ID], [CustomerID], [InsuranceType], [CoverageAmount], [ExpiryDate]) VALUES (6, 6, N'Health Insurance', CAST(13.00 AS Decimal(10, 2)), CAST(N'2025-03-15' AS Date))
GO
SET IDENTITY_INSERT [dbo].[Insurance] OFF
GO
SET IDENTITY_INSERT [dbo].[Locations] ON 
GO
INSERT [dbo].[Locations] ([ID], [BranchName], [Address]) VALUES (1, N'Bydgosccz', N'CzanaDroga 33')
GO
INSERT [dbo].[Locations] ([ID], [BranchName], [Address]) VALUES (2, N'Warsaw', N'FredChop 43')
GO
INSERT [dbo].[Locations] ([ID], [BranchName], [Address]) VALUES (3, N'Krakow', N'Karantowa 03')
GO
INSERT [dbo].[Locations] ([ID], [BranchName], [Address]) VALUES (4, N'Gdansk', N'Grunwaldzka 21')
GO
INSERT [dbo].[Locations] ([ID], [BranchName], [Address]) VALUES (5, N'Sopot', N'Pomorska 10')
GO
INSERT [dbo].[Locations] ([ID], [BranchName], [Address]) VALUES (6, N'Torun', N'Warszawska 57')
GO
SET IDENTITY_INSERT [dbo].[Locations] OFF
GO
SET IDENTITY_INSERT [dbo].[Security] ON 
GO
INSERT [dbo].[Security] ([ID], [CustomerID], [PasswordHash], [LastLogin]) VALUES (1, NULL, N'uedlIUju', CAST(N'2012-05-09T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[Security] ([ID], [CustomerID], [PasswordHash], [LastLogin]) VALUES (2, 3, N'lvDSYCHv', CAST(N'2013-12-12T09:23:00.000' AS DateTime))
GO
INSERT [dbo].[Security] ([ID], [CustomerID], [PasswordHash], [LastLogin]) VALUES (3, 1, N'fgrjkankj', CAST(N'2025-11-10T10:24:00.000' AS DateTime))
GO
INSERT [dbo].[Security] ([ID], [CustomerID], [PasswordHash], [LastLogin]) VALUES (4, 2, N'ktctgctg', CAST(N'2012-05-09T00:00:00.000' AS DateTime))
GO
INSERT [dbo].[Security] ([ID], [CustomerID], [PasswordHash], [LastLogin]) VALUES (5, 1, N'tkcgyhj', CAST(N'2014-12-08T13:30:00.000' AS DateTime))
GO
INSERT [dbo].[Security] ([ID], [CustomerID], [PasswordHash], [LastLogin]) VALUES (6, 4, N'ekwbfju', CAST(N'2005-11-10T10:24:00.000' AS DateTime))
GO
SET IDENTITY_INSERT [dbo].[Security] OFF
GO
ALTER TABLE [dbo].[CustomerProducts]  WITH CHECK ADD  CONSTRAINT [FK_CustomerProducts_BankingProducts] FOREIGN KEY([ProductID])
REFERENCES [dbo].[BankingProducts] ([ID])
GO
ALTER TABLE [dbo].[CustomerProducts] CHECK CONSTRAINT [FK_CustomerProducts_BankingProducts]
GO
ALTER TABLE [dbo].[Customers]  WITH CHECK ADD  CONSTRAINT [FK_Customers_CustomerType] FOREIGN KEY([CustomerTypeID])
REFERENCES [dbo].[CustomerType] ([ID])
GO
ALTER TABLE [dbo].[Customers] CHECK CONSTRAINT [FK_Customers_CustomerType]
GO
ALTER TABLE [dbo].[Insurance]  WITH CHECK ADD  CONSTRAINT [FK_Insurance_Customers] FOREIGN KEY([CustomerID])
REFERENCES [dbo].[Customers] ([ID])
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[Insurance] CHECK CONSTRAINT [FK_Insurance_Customers]
GO
ALTER TABLE [dbo].[Security]  WITH CHECK ADD  CONSTRAINT [FK_Security_Customers] FOREIGN KEY([CustomerID])
REFERENCES [dbo].[Customers] ([ID])
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[Security] CHECK CONSTRAINT [FK_Security_Customers]
GO
ALTER TABLE [dbo].[Security]  WITH CHECK ADD  CONSTRAINT [FK_Security_Security] FOREIGN KEY([CustomerID])
REFERENCES [dbo].[Customers] ([ID])
GO
ALTER TABLE [dbo].[Security] CHECK CONSTRAINT [FK_Security_Security]
GO
/****** Object:  StoredProcedure [dbo].[Delete_Customer_Shadow]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE   PROCEDURE [dbo].[Delete_Customer_Shadow]
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
/****** Object:  StoredProcedure [dbo].[DeleteCustomer]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[DeleteCustomer]
    @CustomerID INT
AS
BEGIN
    DELETE FROM Customers WHERE CustomerID = @CustomerID;
END;
GO
/****** Object:  StoredProcedure [dbo].[InsertCustomer]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE     PROCEDURE [dbo].[InsertCustomer]
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
/****** Object:  StoredProcedure [dbo].[Update_Customer_Shadow]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE     PROCEDURE [dbo].[Update_Customer_Shadow]
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
/****** Object:  StoredProcedure [dbo].[UpdateCustomer]    Script Date: 2/15/2025 8:09:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[UpdateCustomer]
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
GO
USE [master]
GO
ALTER DATABASE [VongaiWitchoBank] SET  READ_WRITE 
GO
