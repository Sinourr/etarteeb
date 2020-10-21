USE [OnlineOlimyAccounting]
GO

/****** Object:  Table [dbo].[LASCompanies]    Script Date: 10/06/2020 1:48:31 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[LASCompanies](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Code] [nvarchar](4) NOT NULL,
	[AName] [nvarchar](50) NOT NULL,
	[EName] [nvarchar](50) NOT NULL,
	[AAddress] [nvarchar](50) NULL,
	[EAddress] [nvarchar](50) NULL,
	[POBox] [nvarchar](10) NULL,
	[Zip] [nvarchar](10) NULL,
	[TelNo1] [nvarchar](20) NULL,
	[TelNo2] [nvarchar](20) NULL,
	[FaxNo1] [nvarchar](20) NULL,
	[FaxNo2] [nvarchar](20) NULL,
	[Email] [nvarchar](50) NULL,
	[WebPage] [nvarchar](50) NULL,
	[OpeningEDate] [smalldatetime] NULL,
	[OpeningADate] [nchar](10) NULL,
	[IsConsolidate] [bit] NULL,
	[ConsldCompID] [int] NULL,
	[IsActive] [bit] NULL,
 CONSTRAINT [PK_LASCompanies_ID] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [IX_LASCompanies_AName] UNIQUE NONCLUSTERED 
(
	[AName] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [IX_LASCompanies_Code] UNIQUE NONCLUSTERED 
(
	[Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [IX_LASCompanies_EName] UNIQUE NONCLUSTERED 
(
	[EName] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[LASCompanies] ADD  CONSTRAINT [DF_ACC03181_CM_CONSLD]  DEFAULT ((0)) FOR [IsConsolidate]
GO

ALTER TABLE [dbo].[LASCompanies] ADD  CONSTRAINT [DF_ACC03181_CM_ACTIVE]  DEFAULT ((0)) FOR [IsActive]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'0 No   & 1 Yeas' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASCompanies', @level2type=N'COLUMN',@level2name=N'IsConsolidate'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'0 No   & 1 Yeas' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASCompanies', @level2type=N'COLUMN',@level2name=N'IsActive'
GO

