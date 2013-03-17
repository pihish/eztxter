USE [atlhoops]
GO
/****** Object:  Table [dbo].[cell_text_emails]    Script Date: 03/17/2013 12:38:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cell_text_emails](
	[Carrier] [varchar](70) NULL,
	[Email] [varchar](150) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
INSERT [dbo].[cell_text_emails] ([Carrier], [Email]) VALUES (N'Alltel', N'@message.alltel.com')
INSERT [dbo].[cell_text_emails] ([Carrier], [Email]) VALUES (N'ATT', N'@txt.att.net')
INSERT [dbo].[cell_text_emails] ([Carrier], [Email]) VALUES (N'Boost Mobile', N'@myboostmobile.com')
INSERT [dbo].[cell_text_emails] ([Carrier], [Email]) VALUES (N'Sprint', N'@messaging.sprintpcs.com')
INSERT [dbo].[cell_text_emails] ([Carrier], [Email]) VALUES (N'T-Mobile', N'@tmomail.net')
INSERT [dbo].[cell_text_emails] ([Carrier], [Email]) VALUES (N'US Cellular', N'@email.uscc.net')
INSERT [dbo].[cell_text_emails] ([Carrier], [Email]) VALUES (N'Verizon', N'@vtext.com')
INSERT [dbo].[cell_text_emails] ([Carrier], [Email]) VALUES (N'Virgin Mobile', N'@vmobl.com')
