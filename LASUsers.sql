USE [Accountingphp]
GO

/****** Object:  Table [dbo].[LASUsers]    Script Date: 10/06/2020 2:51:37 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[LASUsers](
	[UserID] [int] IDENTITY(1,1) NOT NULL,
	[UserNo] [nchar](5) NULL,
	[UserName] [nvarchar](35) NOT NULL,
	[LoginName] [nvarchar](20) NOT NULL,
	[Password] [nchar](10) NULL,
	[UserCreatedDate] [smalldatetime] NULL,
	[ComputerDate] [smalldatetime] NULL,
	[IsActive] [bit] NULL,
	[IsAdmin] [bit] NULL,
	[IsAssist] [bit] NULL,
	[IsAccManager] [bit] NULL,
	[FL1] [int] NULL,
	[FL1DTL] [nchar](7) NULL,
	[FL2] [int] NULL,
	[FL2DTL] [nchar](5) NULL,
	[FL3] [int] NULL,
	[FL3DTL] [nchar](5) NULL,
	[FL4] [int] NULL,
	[FL4DTL] [nchar](5) NULL,
	[FL5] [int] NULL,
	[FL5DTL] [nchar](3) NULL,
	[FL6] [int] NULL,
	[FL6DTL] [nchar](5) NULL,
	[FL7] [int] NULL,
	[FL7DTL] [nchar](5) NULL,
	[FL8] [int] NULL,
	[FL8DTL] [nchar](5) NULL,
	[FL9] [int] NULL,
	[FL9DTL] [nchar](5) NULL,
	[FL10] [int] NULL,
	[FL10DTL] [nchar](1) NULL,
	[FL11] [int] NULL,
	[FL11DTL] [nchar](2) NULL,
	[FL12] [int] NULL,
	[FL12DTL] [nchar](5) NULL,
	[FL13] [int] NULL,
	[FL13DTL] [nchar](1) NULL,
	[FL14] [int] NULL,
	[FL14DTL] [nchar](5) NULL,
	[FL15] [int] NULL,
	[FL15DTL] [nchar](10) NULL,
	[FL16] [int] NULL,
	[FL16DTL] [nchar](10) NULL,
	[FL17] [int] NULL,
	[FL17DTL] [nchar](10) NULL,
	[FL18] [int] NULL,
	[FL18DTL] [nchar](10) NULL,
	[FL19] [int] NULL,
	[FL19DTL] [nchar](10) NULL,
	[FL20] [int] NULL,
	[FL20DTL] [nchar](10) NULL,
	[UpdatedUserID] [int] NULL,
 CONSTRAINT [PK_LASUsers] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [LoginName_LASUsers] UNIQUE NONCLUSTERED 
(
	[LoginName] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [UserNo_LASUsers] UNIQUE NONCLUSTERED 
(
	[UserNo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_IsActive]  DEFAULT ((0)) FOR [IsActive]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_IsAdmin]  DEFAULT ((0)) FOR [IsAdmin]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_IsAssist]  DEFAULT ((0)) FOR [IsAssist]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_IsAccManager]  DEFAULT ((0)) FOR [IsAccManager]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL1]  DEFAULT ((0)) FOR [FL1]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL1DTL]  DEFAULT ((0)) FOR [FL1DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL2]  DEFAULT ((0)) FOR [FL2]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL2DTL]  DEFAULT ((0)) FOR [FL2DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL3]  DEFAULT ((0)) FOR [FL3]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL3DTL]  DEFAULT ((0)) FOR [FL3DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL4]  DEFAULT ((0)) FOR [FL4]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL4DTL]  DEFAULT ((0)) FOR [FL4DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL5]  DEFAULT ((0)) FOR [FL5]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL5DTL]  DEFAULT ((0)) FOR [FL5DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL6]  DEFAULT ((0)) FOR [FL6]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL6DTL]  DEFAULT ((0)) FOR [FL6DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL7]  DEFAULT ((0)) FOR [FL7]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL7DTL]  DEFAULT ((0)) FOR [FL7DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL8]  DEFAULT ((0)) FOR [FL8]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL8DTL]  DEFAULT ((0)) FOR [FL8DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL9]  DEFAULT ((0)) FOR [FL9]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL9DTL]  DEFAULT ((0)) FOR [FL9DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL10]  DEFAULT ((0)) FOR [FL10]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL10DTL]  DEFAULT ((0)) FOR [FL10DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL11]  DEFAULT ((0)) FOR [FL11]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL11DTL]  DEFAULT ((0)) FOR [FL11DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL12]  DEFAULT ((0)) FOR [FL12]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL12DTL]  DEFAULT ((0)) FOR [FL12DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL13]  DEFAULT ((0)) FOR [FL13]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL13DTL]  DEFAULT ((0)) FOR [FL13DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL14]  DEFAULT ((0)) FOR [FL14]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL14DTL]  DEFAULT ((0)) FOR [FL14DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL15]  DEFAULT ((0)) FOR [FL15]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL15DTL]  DEFAULT ((0)) FOR [FL15DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL16]  DEFAULT ((0)) FOR [FL16]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL16DTL]  DEFAULT ((0)) FOR [FL16DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL17]  DEFAULT ((0)) FOR [FL17]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL17DTL]  DEFAULT ((0)) FOR [FL17DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL18]  DEFAULT ((0)) FOR [FL18]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL18DTL]  DEFAULT ((0)) FOR [FL18DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL19]  DEFAULT ((0)) FOR [FL19]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL19DTL]  DEFAULT ((0)) FOR [FL19DTL]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL120_1]  DEFAULT ((0)) FOR [FL20]
GO

ALTER TABLE [dbo].[LASUsers] ADD  CONSTRAINT [DF_LASUsers_FL20DTL_1]  DEFAULT ((0)) FOR [FL20DTL]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'تسجيـل قيـود ا ليـومــيــة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'تسجيل قيود اليومية' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL1DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'دليــل حســابات أ.عــــامية' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'دليــل حســابات أ.عــــامية' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL2DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'دليل حسابات أ. مسـاعـد' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'دليل حسابات أ. مسـاعـد' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL3DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'الـمـوازنــة ا لـتخـطـيـطيـة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL4'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'الـمـوازنــة ا لـتخـطـيـطيـة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL4DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'الـفــترات ا لمـحــاسـبيــة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL5'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'الـفــترات ا لمـحــاسـبيــة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL5DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'مراكــــز التـكـلـــفــــــة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL6'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'مراكــــز التـكـلـــفــــــة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL6DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'المشـاريــع و الأقســــامـــة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL7'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'المشـاريــع و الأقســــامة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL7DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'أكـــواد ا ليـــــومـيـــــات' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL8'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'أكـــواد ا ليـــــومـيـــــات' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL8DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'أكــواد ا لمـســتـنـــــدات' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL9'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'أكــواد ا لمـســتـنـــــدات' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL9DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ثــــوابــــت النــظــــــــــام' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL10'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ثــــوابــــت النــظــــــــــام' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL10DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'مـتسـلسـلات  ا لنـظـــــــام' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL11'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'مـتسـلسـلات  ا لنـظـــــــام' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL11DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'بيــانـــــات ا لمـنــشــــــأت' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL12'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'بيــانـــــات ا لمـنــشــــــأت' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL12DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'الـتحــــكـم في ا لـســـريـــة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL13'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'الـتحــــكـم في ا لـســـريـــة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL13DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'كــلمــــات  ا لـســــــريـــة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL14'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'كــلمــــات  ا لـســــــريـــة' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL14DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'التــــقـــــــاريــــــــــر' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL15'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'التــــقـــــــاريــــــــــر' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL15DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'التــــقـــــــاريــــــــــر' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL16'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'التــــقـــــــاريــــــــــر' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL16DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'التــــقـــــــاريــــــــــر' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL17'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'التــــقـــــــاريــــــــــر' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL17DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'التــــقـــــــاريــــــــــر' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL18'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'التــــقـــــــاريــــــــــر' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL18DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL19'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL19DTL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL20'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'LASUsers', @level2type=N'COLUMN',@level2name=N'FL20DTL'
GO

