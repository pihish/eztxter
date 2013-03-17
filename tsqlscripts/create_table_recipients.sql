USE [atlhoops]
GO

/****** Object:  Table [dbo].[recipients]    Script Date: 03/17/2013 12:34:34 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[recipients](
	[row_number] [int] NULL,
	[name] [varchar](60) NULL,
	[email] [varchar](70) NULL,
	[phone] [varchar](15) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


