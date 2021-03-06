USE [qms_atrail]
GO
/****** Object:  StoredProcedure [dbo].[auditTrail_sp]    Script Date: 03/18/2015 14:17:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[auditTrail_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[auditTrail_sp]
	-- Add the parameters for the stored procedure here
	@syscode varchar(max) = '''',
	@userid varchar(max) = '''',
	@trandesc varchar(max) = '''',
	@type varchar(max) = ''''
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;

	merge dbo.tran_acvty_hdr as target
	using (select * from openquery([MYSQL_GENDB],''select user_name from gendb.ruser where user_id = ''''@userid'''''')) as src
		  (user_name)
	on (target.sys_code = @syscode and
		target.user_id = @userid)
	when matched then
		update set tran_dt = {fn NOW()}, tran_time = CONVERT(time,CURRENT_TIMESTAMP), tran_desc = @trandesc, tran_type = @type
	when not matched then
		insert (sys_code, user_id, username, tran_dt, tran_time, tran_desc, tran_type)
		values (@syscode, @userid, src.user_name, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), @trandesc, @type);
		
	merge dbo.tran_acvty_ctr as target
	using (select * from openquery([MYSQL_GENDB],''select user_name from gendb.ruser where user_id = ''''@userid'''''')) as src
		  (user_name)
	on (target.sys_code = @syscode and
		target.user_id = @userid and
		target.tran_dt = {fn NOW()} and
		target.tran_desc = @trandesc and
		target.tran_type = @type)
	when matched then
		update set tran_count = target.tran_count + 1
	when not matched then
		insert (sys_code, user_id, username, tran_dt, tran_desc, tran_type)
		values (@syscode, @userid, src.user_name, {fn NOW()}, @trandesc, @type);
	
    IF @@ERROR > 0
        goto _FAIL
    ELSE
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
