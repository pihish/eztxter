USE [atlhoops]
GO

/****** Object:  StoredProcedure [dbo].[sendemail]    Script Date: 03/17/2013 12:31:08 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[sendemail]

AS

BEGIN

DECLARE @BCCMAIL AS VARCHAR(70)
DECLARE @NEWSUBJECT AS VARCHAR(50)
DECLARE @NEWBODY AS VARCHAR(300)
DECLARE @RECPIENTCOUNT AS INT
DECLARE @ACTIVEROW AS INT
DECLARE @MAIL AS VARCHAR(MAX)
DECLARE @BEFOREEMAIL AS VARCHAR(MAX)
DECLARE @LASTROW3 AS INT
DECLARE @ACTIVEROW3 AS INT

SET @BCCMAIL = 'your blind copy recipient'
SET @NEWSUBJECT = 'subject line'
SET @NEWBODY = (SELECT *
			    FROM message)
SET @RECPIENTCOUNT = (SELECT COUNT(name)
				      FROM recipients)
SET @ACTIVEROW = 1

WHILE @RECPIENTCOUNT >=  @ACTIVEROW
	BEGIN
		IF @ACTIVEROW = 1
			BEGIN
				SET @MAIL = (SELECT email
								 FROM recipients
								 WHERE row_number = @ACTIVEROW)
			END
		ELSE 
			BEGIN
						SET @MAIL = @MAIL + '; ' + (SELECT email
											   FROM recipients
											   WHERE row_number = @ACTIVEROW)
			END
		SET @ACTIVEROW = @ACTIVEROW + 1
	END

EXEC MSDB.DBO.sp_send_dbmail 
	@PROFILE_NAME = 'atlhoops',
	@RECIPIENTS = @MAIL,
	@BLIND_COPY_RECIPIENTS = @BCCMAIL,
	@SUBJECT = @NEWSUBJECT,
	@BODY = @NEWBODY,
	@BODY_FORMAT = 'HTML';

END

GO


