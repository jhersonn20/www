USE [qms_pip]
GO
/****** Object:  StoredProcedure [dbo].[toCsv_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[toCsv_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[toCsv_sp]
	-- Add the parameters for the stored procedure here
	@query varchar(max),
	@file varchar(max)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	begin transaction;

	declare @exec varchar(max);

	--set @query = ''create table #table(id int, vchar varchar(max));'';
	--set @query = @query + ''SET NOCOUNT ON;'';
	--set @query = @query + ''insert into #table values(1, ""romel""),(2, ""ellaine"");'';
	--set @query = @query + ''select * from #table;'';
	--set @query = @query + ''drop table #table;'';
	set @file = ''C:\wamp\www\assets\text\'' + @file;
	set @exec = ''sqlcmd -S "'' + @@SERVERNAME + ''" -d qms_pip -E -Q "'' + @query + ''" -o "'' + @file + ''" -h-1 -s "," -w 700'';
	exec(''exec master..xp_cmdshell '''''' + @exec + '''''''');
	
    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>
	
    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	--SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[pwWhse_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[pwWhse_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[pwWhse_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	begin transaction;

	update dbo.pow_spool set whse_spl_recvd_date = null, whse_spl_release_date = null;
	
	update t set whse_spl_recvd_date = t2.recvd_date, whse_spl_release_date = t2.issued_date
		from dbo.pow_spool t inner join dbo.pip_wspl_data t2
		on (t.pip_iso_no = t2.pip_iso_no or
			t.pip_iso_no = t2.pip_iso_no1) and
			t.spool_no = t2.spool_no;
    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[pwQaqc_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[pwQaqc_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[pwQaqc_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	begin transaction;
			
	declare @action TABLE(change VARCHAR(20))
	declare @pip_iso_no varchar(max);
	declare @spool_no varchar(max);
	declare @spool_category varchar(max);
	declare crs cursor read_only
		for select pip_iso_no, spool_no, spool_category from dbo.pip_fspl_data
				
	open crs
	fetch next from crs into @pip_iso_no, @spool_no,@spool_category
	while @@FETCH_STATUS = 0
	begin
		merge dbo.pow_spool as target
		using (select @pip_iso_no, @spool_no, @spool_category) as src (pip_iso_no, spool_no, spool_category)
		on (target.pip_iso_no = src.pip_iso_no and
			target.spool_no1 = src.spool_no)
		when matched then
			update set spool_category = src.spool_category
		when not matched then
			insert (pip_iso_no, spool_no, spool_no1, spool_category, loguser, logdate, logtime, logupdate, datasource)
			values(src.pip_iso_no, src.spool_no, src.spool_no, src.spool_category, user, {fn NOW()}, convert(time, current_timestamp), ''Upload WENDS Spool Data'', ''QAQC'')
		output $action into @action;
				
		if ((select change from @action) = ''INSERT'')
		begin
			if ((select top 1 1 from dbo.ttsys t where t.sys_no = dbo.entry_fn(1,@pip_iso_no,''-'')) = 1)
			begin
				update t set sys_no = (
						select top 1 sys_no from dbo.ttsys t where t.sys_no = dbo.entry_fn(1,@pip_iso_no,''-'')
					), piping_class = (
						select top 1 ''U/G'' from dbo.ttsys t where t.sys_no = dbo.entry_fn(1,@pip_iso_no,''-'')
					)
					from dbo.pow_spool t where t.PROGRESS_RECID = @@IDENTITY;
			end
			else if ((select top 1 1 from dbo.ttsys t where t.sys_no = dbo.entry_fn(2,@pip_iso_no,''-'')) = 1)
			begin
				update t set sys_no = (
						select top 1 sys_no from dbo.ttsys t where t.sys_no = dbo.entry_fn(2,@pip_iso_no,''-'')
					), piping_class = (
						select top 1 ''A/G'' from dbo.ttsys t where t.sys_no = dbo.entry_fn(2,@pip_iso_no,''-'')
					)
					from dbo.pow_spool t where t.PROGRESS_RECID = @@IDENTITY;
			end
			else
			begin
				update t set sys_no = '''', piping_class = ''''
					from dbo.pow_spool t where t.PROGRESS_RECID = @@IDENTITY;
			end
		end
		else if ((select change from @action) = ''UPDATE'')
		begin
			if ((select sys_no from dbo.pow_spool t where t.PROGRESS_RECID = @@IDENTITY) = '''')
			begin
				if ((select top 1 1 from dbo.ttsys t where t.sys_no = dbo.entry_fn(1,@pip_iso_no,''-'')) = 1)
				begin
					update t set sys_no = (
							select top 1 sys_no from dbo.ttsys t where t.sys_no = dbo.entry_fn(1,@pip_iso_no,''-'')
						), piping_class = (
							select top 1 ''U/G'' from dbo.ttsys t where t.sys_no = dbo.entry_fn(1,@pip_iso_no,''-'')
						)
						from dbo.pow_spool t where t.PROGRESS_RECID = @@IDENTITY;
				end
				else if ((select top 1 1 from dbo.ttsys t where t.sys_no = dbo.entry_fn(2,@pip_iso_no,''-'')) = 1)
				begin
					update t set sys_no = (
							select top 1 sys_no from dbo.ttsys t where t.sys_no = dbo.entry_fn(2,@pip_iso_no,''-'')
						), piping_class = (
							select top 1 ''A/G'' from dbo.ttsys t where t.sys_no = dbo.entry_fn(2,@pip_iso_no,''-'')
						)
						from dbo.pow_spool t where t.PROGRESS_RECID = @@IDENTITY;
				end
				else
				begin
					update t set sys_no = '''', piping_class = ''''
						from dbo.pow_spool t where t.PROGRESS_RECID = @@IDENTITY;
				end
			end
			else
			begin
				if ((select top 1 1 from dbo.ttsys t where t.sys_no = dbo.entry_fn(1,@pip_iso_no,''-'')) = 1)
				begin
					update t set piping_class = (
							select top 1 ''U/G'' from dbo.ttsys t where t.sys_no = dbo.entry_fn(1,@pip_iso_no,''-'')
						)
						from dbo.pow_spool t where t.PROGRESS_RECID = @@IDENTITY;
				end
				else if ((select top 1 1 from dbo.ttsys t where t.sys_no = dbo.entry_fn(2,@pip_iso_no,''-'')) = 1)
				begin
					update t set piping_class = (
							select top 1 ''A/G'' from dbo.ttsys t where t.sys_no = dbo.entry_fn(2,@pip_iso_no,''-'')
						)
						from dbo.pow_spool t where t.PROGRESS_RECID = @@IDENTITY;
				end
				else
				begin
					update t set piping_class = ''''
						from dbo.pow_spool t where t.PROGRESS_RECID = @@IDENTITY;
				end
			end
		end
			
		fetch next from crs into @pip_iso_no, @spool_no,@spool_category
	end
	close crs
	deallocate crs
	
	update dbo.pow_spool set release_no = '''', release_date = null, qc_release_no = '''', qc_release_date = null, qc_fwhse_recvd_date = null, fwhse_pntg_recvd_date = null, pntg_blasting_date = null, pntg_primer_date = null, pntg_intermediate_date = null, pntg_painted_date = null, pntg_release_date = null, pntg_release_no = '''', qaqc = 0, qaqc_remarks = ''Ask for QAQC Verification and Assitance'';
	
	update t set release_no = t2.release_no, release_date = t2.release_date, qc_release_no = t.qc_release_no, qc_release_date = t.qc_release_date, qc_fwhse_recvd_date = t.qc_fwhse_recvd_date, fwhse_pntg_recvd_date = t.fwhse_pntg_recvd_date, pntg_blasting_date = t.pntg_blasting_date, pntg_primer_date = t.pntg_primer_date, pntg_intermediate_date = t.pntg_intermediate_date, pntg_painted_date = t.pntg_painted_date, pntg_release_date = t.pntg_release_date, pntg_release_no = t.pntg_release_no, qaqc = 1, qaqc_remarks = ''''
		from dbo.pow_spool t inner join dbo.pip_fspl_data t2
		on t.pip_iso_no = t2.pip_iso_no and
		   t.spool_no1 = t2.spool_no;
	--declare crs cursor read_only
	--	for select pip_iso_no, spool_no, spool_category from dbo.pip_fspl_data
			
	--declare @pow_pip_iso_no varchar(max);
	--declare @pow_spool_no1 varchar(max);	
	--declare @pow_PROGRESS_RECID bigint;
	--open crs_tt
	--fetch next from crs_tt into @pow_pip_iso_no, @pow_spool_no1, @pow_PROGRESS_RECID
	--while @@FETCH_STATUS = 0
	--begin
	--	update t set release
			
	--	fetch next from crs_tt into @pow_pip_iso_no, @pow_spool_no1, @pow_PROGRESS_RECID
	--end
	--close crs_tt
	--deallocate crs_tt
    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[pwFab_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[pwFab_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[pwFab_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	begin transaction;

	update dbo.pow_spool set fabricated = 0, fab_spl_date = null;
	
	update t set fabricated = 1, fab_spl_date = t2.fab_spl_date
		from dbo.pow_spool t inner join dbo.pip_fabspl_data t2
		on t.pip_iso_no = t2.pip_iso_no and
		   t.spool_no = t2.spool_no and
		   t.spool_no1 = t2.spool_no1
		where t2.fab_spl_date is not null;

    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[pwEngg_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[pwEngg_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[pwEngg_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;
	
	delete from dbo.pow_spool;
	
	declare @pip_iso_no varchar(max)
	declare @spool_no varchar(max)
	declare @piping_class varchar(max)
	declare @constn_area varchar(max)
	declare @sheet_no varchar(max)
	declare @rev_no varchar(max)
	declare @spool_no1 varchar(max)
	declare @priority_no varchar(max)
	declare @priority_timing varchar(max)
	declare @lb_sb varchar(max)
	declare @spool_category varchar(max)
	declare @field_desc varchar(max)
	declare @sys_no varchar(max)
	declare @linear_shop varchar(max)
	declare @linear_total_lm decimal
	declare @weld_field decimal
	declare @weld_shop decimal
	declare @weld_threaded decimal
	declare @weld_total_dia decimal
	declare @PROGRESS_RECID bigint
	declare crs cursor read_only
		for select pip_iso_no, spool_no, piping_class, constn_area, sheet_no, rev_no, spool_no1, priority_no, priority_timing, 
				   lb_sb, spool_category, field_desc, sys_no, linear_shop, linear_total_lm, weld_field, weld_shop, weld_threaded,
				   weld_total_dia, PROGRESS_RECID from dbo.ttspl
				
	open crs
	fetch next from crs into @pip_iso_no, @spool_no, @piping_class, @constn_area, @sheet_no, @rev_no, @spool_no1, @priority_no, @priority_timing, 
				   @lb_sb, @spool_category, @field_desc, @sys_no, @linear_shop, @linear_total_lm, @weld_field, @weld_shop, @weld_threaded, @weld_total_dia, @PROGRESS_RECID
	while @@FETCH_STATUS = 0
	begin
		merge dbo.pow_spool as target
		using (select @pip_iso_no, @spool_no, @piping_class, @constn_area, @sheet_no, @rev_no, @spool_no1, @priority_no, @priority_timing, 
				   @lb_sb, @spool_category, @field_desc, @sys_no, @linear_shop, @linear_total_lm, @weld_field, @weld_shop, @weld_threaded, @weld_total_dia) as src
			  (pip_iso_no, spool_no, piping_class, constn_area, sheet_no, rev_no, spool_no1, priority_no, priority_timing, 
				   lb_sb, spool_category, field_desc, sys_no, linear_shop, linear_total_lm, weld_field, weld_shop, weld_threaded, weld_total_dia)
		on (target.pip_iso_no = src.pip_iso_no and
			target.spool_no = src.spool_no)
		when matched then
			update set spool_no = (case when (target.datasource = ''QAQC'') then src.spool_no else target.spool_no end),
					   spool_no1 = (case when (target.datasource = ''QAQC'') then src.spool_no1 else target.spool_no1 end),
					   logupdate = (case when (target.datasource = ''QAQC'') then ''QAQC Updated from Spool List Data'' else target.logupdate end),
					   datasource = (case when (target.datasource = ''QAQC'') then ''ENGG'' else target.datasource end),
					   piping_class = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.piping_class else target.piping_class end),
					   constn_area = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.constn_area else target.constn_area end),
					   sheet_no = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.sheet_no else target.sheet_no end),
					   rev_no = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.rev_no else target.rev_no end),
					   priority_no = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.priority_no else target.priority_no end),
					   priority_timing = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.priority_timing else target.priority_timing end),
					   lb_sb = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.lb_sb else target.lb_sb end),
					   spool_category = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.spool_category else target.spool_category end),
					   field_desc = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.field_desc else target.field_desc end),
					   sys_no = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.sys_no else target.sys_no end),
					   linear_shop = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.linear_shop else target.linear_shop end),
					   linear_total_lm = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.linear_total_lm else target.linear_total_lm end),
					   weld_field = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.weld_field else target.weld_field end),
					   weld_shop = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.weld_shop else target.weld_shop end),
					   weld_threaded = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.weld_threaded else target.weld_threaded end),
					   weld_total_dia = (case when (target.datasource = ''QAQC'' or target.spool_no = src.spool_no) then src.weld_total_dia else target.weld_total_dia end)
		when not matched then
			insert (piping_class, constn_area, pip_iso_no, sheet_no, rev_no, spool_no, spool_no1, priority_no, priority_timing, 
				   lb_sb, spool_category, field_desc, sys_no, linear_shop, linear_total_lm, weld_field, weld_shop, weld_threaded, weld_total_dia,
				   loguser, logdate, logtime, logupdate, datasource)
			values (src.piping_class, src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.spool_no, src.spool_no1, src.priority_no, src.priority_timing, 
				   src.lb_sb, src.spool_category, src.field_desc, src.sys_no, src.linear_shop, src.linear_total_lm, src.weld_field, src.weld_shop, src.weld_threaded, src.weld_total_dia,
				   user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'', ''ENGG'');
		
		declare @event tinyint = 0
		update t set @event = 1
			from dbo.pow_spool t where t.spool_no = @spool_no;
			
		if (@event = 0)
			insert into tempdb_sql.dbo.tt_ttspl
				select * from dbo.ttspl t where t.PROGRESS_RECID = @PROGRESS_RECID;
		
		fetch next from crs into @pip_iso_no, @spool_no, @piping_class, @constn_area, @sheet_no, @rev_no, @spool_no1, @priority_no, @priority_timing, 
				   @lb_sb, @spool_category, @field_desc, @sys_no, @linear_shop, @linear_total_lm, @weld_field, @weld_shop, @weld_threaded, @weld_total_dia, @PROGRESS_RECID
	end
	close crs
	deallocate crs
	
	update dbo.pow_spool set engr = 0, engr_remarks = ''Ask for Engineering Verification and Assistance'';
		
	update t set t.engr = 1, t.engr_remarks = ''''
		from dbo.pow_spool t inner join dbo.ttspl t2
		on t.pip_iso_no = t2.pip_iso_no and
		   t.spool_no = t2.spool_no
	
	--declare @file varchar(max) = ''invalid_engg_spl_asof_'' + convert(varchar(max), convert(date, {fn NOW()})) + ''.csv'';
	--exec dbo.toCsv_sp ''set nocount on;SELECT pip_iso_no, spool_no1, spool_no, piping_class, lb_sb from tempdb_sql.dbo.tt_ttspl'',@file;

    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[mtoWeld2_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[mtoWeld2_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[mtoWeld2_sp]
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
    BEGIN TRANSACTION;
	
	IF OBJECT_ID(''tempdb...#ttdupjnt'') IS NOT NULL
	BEGIN
		DROP TABLE #ttdupjnt
	END
	create table #ttdupjnt(
		plant_no varchar(max),
		area_no varchar(max),
		drawing_no varchar(max),
		sheet_no varchar(max),
		spool_no varchar(max),
		joint_no varchar(max)
	)

	update t set t.stat = ''In-Active''
		from piping.dbo.joints t;
			  
	update t set t.stat = ''In-Active''
		from piping.dbo.tra_joints_pip t;
		
	delete from piping.dbo.h_joints;
	delete from piping.dbo.h_tra_joints_pip;
		
	insert into piping.dbo.joints(plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, joint_no, joint_type, mat_type, line_class, size, diainch, weld_loc, lbsb, test_pack, loguser, logdate, logupdate)
	select ''1240'', t.constn_area, t.pip_iso_no, t.sheet_no, ISNULL(t3.rev_no,t.rev_no), ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else t.spool_no1 end)), t.join_no, t.joint_type, t.weld_location, t.line_class, t.size, convert(decimal,t.size), (case when(CHARINDEX(''FAB'',UPPER(t.weld_location),1) = 1 OR CHARINDEX(''SHOP'',UPPER(t.weld_location),1) = 1) then 1 else 0 end), t.lb_sb, t.tp_no, t.loguser, t.logdate, t.logupdate
		from dbo.pip_weld_data t
		left outer join piping.dbo.joints t2
		on t.constn_area = t2.area_no and
		   t.pip_iso_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else t.spool_no1 end)) = t2.spool_no and
		   t.joint_no = t2.joint_no
		left outer join #ttiso_temp t3
		on t.constn_area = t3.area_no and
		   t.pip_iso_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no
		where t2.plant_no = ''1240'' and
			  t2.drawing_no is null and
			  t3.plant_no = ''1240'';
			  
	update t
		set t.rev_no = ISNULL(t3.rev_no,t2.rev_no),
			t.stat = ''Active'',
			t.lbsb = t2.lb_sb,
			t.mat_type = t2.weld_location,
			t.joint_type = t2.joint_type,
			t.test_pack = t2.tp_no,
			t.loguser = t2.loguser,
			t.logdate = t2.logdate,
			t.logupdate = t2.logupdate
		from piping.dbo.joints t
		inner join dbo.pip_weld_data t2
		on t.area_no = t2.constn_area and
		   t.drawing_no = t2.pip_iso_no and
		   t.sheet_no = t2.sheet_no and
		   t.spool_no = ISNULL(t2.spool_no1,(case when(t2.spool_no1 = '''') then ''EM'' else t2.spool_no1 end)) and
		   t.joint_no = t2.joint_no
		left outer join #ttiso_temp t3
		on t.constn_area = t3.area_no and
		   t.pip_iso_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no
		where t.plant_no = ''1240'' and
			  t3.plant_no = ''1240'';
		
	insert into #ttdupjnt(plant_no, area_no, drawing_no, sheet_no, spool_no, joint_no)
	select ''1240'', t.constn_area, t.pip_iso_no, t.sheet_no, ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else t.spool_no1 end)), t.joint_no
		from dbo.pip_weld_data t
		left outer join piping.dbo.joints t2
		on t.constn_area = t2.area_no and
		   t.pip_iso_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else t.spool_no1 end)) = t2.spool_no and
		   t.joint_no = t2.joint_no
		where t2.stat = ''Active'';
		
	insert into piping.dbo.tra_joints_pip(plant_no, area_no, drawing_no, sheet_no, revision, spool_no, joint_no, size, weld_loc, bore_size, spl_dwg)
	select ''1240'', t.constn_area, t.pip_iso_no, t.sheet_no, t.rev_no, ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then '''' else t.spool_no1 end)), t.joint_no, t.size, (case when(CHARINDEX(''FAB'',t.weld_location,1) = 1 OR CHARINDEX(''S'',t.weld_location,1) = 1) then 1 else 0 end), (case when(upper(t.lb_sb) = ''LB'') then 1 else 0 end), ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then '''' else (t.pip_iso_no + ''-'' + t.spool_no) end))
		from dbo.pip_weld_data t
		left outer join piping.dbo.tra_joints_pip t2
		on t.constn_area = t2.area_no and
		   t.pip_iso_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   t.rev_no = t2.revision and
		   ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else t.spool_no1 end)) = t2.spool_no and
		   t.joint_no = t2.joint_no
		where t2.plant_no = ''1240'' and
			  t2.drawing_no is null;
			  
	update t
		set t.revision = t2.rev_no
		from piping.dbo.tra_joints_pip t
		inner join dbo.pip_weld_data t2
		on t.area_no = t2.constn_area and
		   t.drawing_no = t2.pip_iso_no and
		   t.sheet_no = t2.sheet_no and
		   t.spool_no = ISNULL(t2.spool_no1,(case when(t2.spool_no1 = '''') then ''EM'' else t2.spool_no1 end)) and
		   t.joint_no = t2.joint_no
		where t.plant_no = ''1240''
		
	insert into piping.dbo.spool(plant_no, area_no, drawing_no, sheet_no, rev_no, lbsb, spool_no, spool_id, weld_loc, spl_type, lengg, iso_stat, tot_lm, system_no, sub_system, testpack_no, mat_type, paint_reqd)
	select ''1240'', t.constn_area, t.pip_iso_no, t.sheet_no, ISNULL(t3.rev_no,t.rev_no), '''', ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else t.spool_no1 end)), t.spool_no, (case when(CHARINDEX(''FAB'',t.weld_location,1) = 1 OR CHARINDEX(''S'',t.weld_location,1) = 1) then 1 else 0 end), ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else ''Spool'' end)), 1, ''Active'', 0, SUBSTRING(ltrim(rtrim(t.tp_no)),1,3), SUBSTRING(ltrim(rtrim(t.tp_no)),1,7), t.tp_no, isnull(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else(case when(t.joint_category = '''') then ''Spool'' else t.joint_category end) end)), 0
		from dbo.pip_weld_data t
		left outer join piping.dbo.spool t2
		on t.constn_area = t2.area_no and
		   t.pip_iso_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   isnull(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else t.spool_no1 end)) = t2.spool_no
		left outer join #ttiso_temp t3
		on t.constn_area = t3.area_no and
		   t.pip_iso_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no
		where t2.plant_no = ''1240'' and
			  t2.drawing_no is null and
			  t3.plant_no = ''1240'';
			  
	update t
		set t.rev_no = ISNULL(t3.rev_no,t2.rev_no),
			t.stat = ''Active''
		from piping.dbo.spool t
		inner join dbo.pip_weld_data t2
		on t.area_no = t2.constn_area and
		   t.drawing_no = t2.pip_iso_no and
		   t.sheet_no = t2.sheet_no and
		   t.spool_no = isnull(t2.spool_no1,(case when(t2.spool_no1 = '''') then ''EM'' else t2.spool_no1 end))
		left outer join #ttiso_temp t3
		on t2.constn_area = t3.area_no and
		   t2.pip_iso_no = t3.drawing_no and
		   t2.sheet_no = t3.sheet_no
		where t.plant_no = ''1240'' and
			  t3.plant_no = ''1240'';
			  
	insert into piping.dbo.h_joints
		select * from piping.dbo.joints where stat = ''In-Active'';
		
	delete from piping.dbo.joints where stat = ''In-Active'';
			  
	insert into piping.dbo.h_tra_joints_pip
		select * from piping.dbo.tra_joints_pip where stat = ''In-Active'';;
	
	delete from piping.dbo.tra_joints_pip where stat = ''In-Active'';
		
	update t
		set t.fw_diainch = t2.totDia_em,
			t.sw_diainch = t2.totDia_sw
		from piping.dbo.spool t
		cross apply (
			select SUM(case when(spool_no = ''EM'') then diainch else 0 end) as totDia_em,
				   SUM(case when(spool_no != ''EM'') then diainch else 0 end) as totDia_sw
				from piping.dbo.joints
				where plant_no = t.plant_no and
					  area_no = t.area_no and
					  drawing_no = t.drawing_no and
					  sheet_no = t.sheet_no and
					  rev_no = t.rev_no and
					  spool_no = t.spool_no
				group by plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no
			) t2
		
	update t
		set t.total_em = t2.totDia_em,
			t.total_emdia = t2.totDia_emDia,
			t.tot_spl = t2.totDia_spl,
			t.tot_spldia = t2.totDia_splDia
		from piping.dbo.iso t
		cross apply (
			select count(case when(spool_no = ''EM'') then 1 else 0 end) as totDia_em,
				   SUM(case when(spool_no = ''EM'') then diainch else 0 end) as totDia_emDia,
				   count(case when(spool_no != ''EM'') then 1 else 0 end) as totDia_spl,
				   SUM(case when(spool_no != ''EM'') then diainch else 0 end) as totDia_splDia
				from piping.dbo.joints
				where plant_no = t.plant_no and
					  area_no = t.area_no and
					  drawing_no = t.drawing_no and
					  sheet_no = t.sheet_no and
					  rev_no = t.rev_no
				group by plant_no, area_no, drawing_no, sheet_no
			) t2
		
    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[mtoWeld_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[mtoWeld_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[mtoWeld_sp]
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
    BEGIN TRANSACTION;
    
    declare @clist as varchar(max) = ''A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z'';
    
    update t set stat = ''In-Active''
		from piping.dbo.mat_takeoff_perspool t;
		
	update t set stat = ''In-Active'', tot_lm = 0
		from piping.dbo.spool t;
		
	update t set stat = ''In-Active'', tot_lm = 0
		from piping.dbo.iso t;
		
	delete from piping.dbo.h_mat_takeoff_perspool;
	delete from piping.dbo.h_spool;
	delete from piping.dbo.h_iso;
	
	IF OBJECT_ID(''tempdb...#ttiso_temp'') IS NOT NULL
	BEGIN
		DROP TABLE #ttiso_temp
	END
	select ''1240'' as plant_no, t.constn_area as area_no, t.pip_iso_no as drawing_no, t.sheet_no, t.rev_no, max(t2.seq) as seq
		into #ttiso_temp
		from dbo.pip_mto_data t
		inner join dbo.rev_sort t2
		on t.rev_no = t2.rev_no
		where upper(t2.draw_type) = ''ISO''
		group by t.constn_area, t.pip_iso_no, t.sheet_no, t.rev_no
	
	insert into #ttiso_temp	
		select ''1240'' as plant_no, t.constn_area as area_no, t.pip_iso_no as drawing_no, t.sheet_no, t.rev_no, max(t2.seq) as seq		
			from dbo.pip_weld_data t
			inner join dbo.rev_sort t2
			on t.rev_no = t2.rev_no
			where upper(t2.draw_type) = ''ISO''
			group by t.constn_area, t.pip_iso_no, t.sheet_no, t.rev_no

	insert into piping.dbo.testpack_hdr(testpack_no, system_no, sub_system, tp_type, serv_line, pid, scope, test_pressure)
	select tp_no, SUBSTRING(RTRIM(ltrim(tp_no)),1,3), SUBSTRING(RTRIM(ltrim(tp_no)),1,7), max(tp_type_of_test) as tp_type_of_test, max(serv_line_desc) as serv_line_desc, max(p_id) as p_id, ''ARCC'', (case when(ISNUMERIC(max(test_pressure)) = 1) then CONVERT(decimal,max(test_pressure)) else 0 end)
		from dbo.pip_mto_data
		group by tp_no
		
	insert into piping.dbo.system(system_no, system_desc)
	select SUBSTRING(RTRIM(ltrim(tp_no)),1,3), SUBSTRING(RTRIM(ltrim(tp_no)),1,3)
		from dbo.pip_mto_data
		group by SUBSTRING(RTRIM(ltrim(tp_no)),1,3)
		
	insert into piping.dbo.mat_takeoff_perspool(plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, item_code, commodity_code, qty, size, length, category, mat_type, isc_no, date_posted, testpack_no, weld_loc, user_id, spl_type, stat, mat_desc, uom, lbsb)
	select ''1240'', t.constn_area, t.pip_iso_no, t.sheet_no, ISNULL(t3.rev_no,t.rev_no), ISNULL(t.spool_no1,(case when(ltrim(rtrim(t.spool_no1)) = '''') then ''EM'' else t.spool_no1 end)), t.item_code, t.item_code, t.qty, t.size, t.total_length, t.group_1, t.group_2, t.item_no, {fn NOW()}, t.tp_no, ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then 0 else 1 end)), ''sa uploaded'', ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else ''Spool'' end)), ''Active'', t.mat_description, ISNULL(t.group_1,(case when(t.group_1 = '''') then ''M'' else ''PC'' end)), t.lb_sb
		from dbo.pip_mto_data t
		left outer join piping.dbo.mat_takeoff_perspool t2
		on t.constn_area = t2.area_no and
		   t.pip_iso_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else ''Spool'' end)) = t2.spool_no and
		   t.item_code = t2.commodity_code and
		   t.size = t2.size and
		   t.item_no = t2.isc_no
		left outer join #ttiso_temp t3
		on t.constn_area = t3.area_no and
		   t.pip_iso_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no
		where t2.plant_no = ''1240'' and
			  t2.drawing_no is null and
			  t3.plant_no = ''1240'';
		
	insert into piping.dbo.material_file(stock_no, item_code, description, unit, uom, size, commodity_code, schedule, mat_type, item, log_user, log_date)
	select t.item_code, t.item_code, t.mat_description, (case when(upper(t.group_1) = ''PIPE'') then ''M'' else ''PC'' end), (case when(upper(t.group_1) = ''PIPE'') then ''M'' else ''PC'' end), t.size, t.item_code, t.schedule_1, t.group_1, t.group_2, ''uploaded'', {fn NOW()}
		from dbo.pip_mto_data t
		left outer join piping.dbo.mat_takeoff_perspool t2
		on t.constn_area = t2.area_no and
		   t.pip_iso_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else ''Spool'' end)) = t2.spool_no and
		   t.item_code = t2.commodity_code and
		   t.size = t2.size and
		   t.item_no = t2.isc_no
		left outer join piping.dbo.material_file t3
		on t.item_code = t3.stock_no and
		   t.item_code = t3.item_code and
		   t.item_code = t3.commodity_code and
		   t.size = t3.size
		where t2.plant_no = ''1240'' and
			  t2.drawing_no is null and
			  t3.commodity_code is null;
		
	insert into piping.dbo.material_file_dtl(disc_code, disc_desc, stock_no, item_code, commodity_code, size, flg_status, log_user, log_date)
	select ''PIP'', ''PIPING'', t.item_code, t.item_code, t.item_code, t.size, 1, ''uploaded'', {fn NOW()}
		from dbo.pip_mto_data t
		left outer join piping.dbo.mat_takeoff_perspool t2
		on t.constn_area = t2.area_no and
		   t.pip_iso_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else ''Spool'' end)) = t2.spool_no and
		   t.item_code = t2.commodity_code and
		   t.size = t2.size and
		   t.item_no = t2.isc_no
		left outer join piping.dbo.material_file_dtl t3
		on t.item_code = t3.stock_no and
		   t.item_code = t3.item_code and
		   t.item_code = t3.commodity_code
		where t2.plant_no = ''1240'' and
			  t2.drawing_no is null and
			  upper(t3.disc_code) = ''PIP'' and
			  t3.disc_code is null;
		
	update t 
		set t.rev_no = ISNULL(t3.rev_no,t2.rev_no),
			t.stat = ''Active'',
			t.mat_desc = t2.mat_description,
			t.qty = t2.qty,
			t.uom = (case when(upper(t2.group_1) = ''PIPE'') then ''M'' else ''PC'' end),
			t.lbsb = t2.lb_sb
		from piping.dbo.mat_takeoff_perspool t
		inner join dbo.pip_mto_data t2
		on t.area_no = t2.constn_area and
		   t.drawing_no = t2.pip_iso_no and
		   t.sheet_no = t2.sheet_no and
		   t.spool_no = ISNULL(t2.spool_no1,(case when(t2.spool_no1 = '''') then ''EM'' else t2.spool_no1 end)) and
		   t.commodity_code = t2.item_code and
		   t.size = t2.size and
		   t.isc_no = t2.item_no
		left outer join #ttiso_temp t3
		on t2.constn_area = t3.area_no and
		   t2.pip_iso_no = t3.drawing_no and
		   t2.sheet_no = t3.sheet_no
		where t.plant_no = ''1240''
		
	insert into piping.dbo.iso(discipline, plant_no, area_no, drawing_no, sheet_no, rev_no, lbsb, line_no, lineclass, painting, insulation, fluid_code, stat, tot_lm, systemto, priority_code, priority_timing, area_loc, piping_class, matl, insulation_thickness, loguser, logdate, logupdate)
	select ''1240-Piping'', ''1240'', t.constn_area, t.pip_iso_no, t.sheet_no, ISNULL(t3.rev_no,t.rev_no), t.iso_lb_sb, t.line_no, t.line_class, t.painting_specs, t.insul_type, t.serv_line_code, ''Active'', t.total_length, t.tp_no, t.priority_no, t.priority_timing, t.area_desc, t.piping_class, ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else ''FAB'' end)), STR(t.insul_lm_untraced + t.insul_lm_traced), t.loguser, t.logdate, t.logupdate
		from dbo.pip_mto_data t
		left outer join piping.dbo.iso t2
		on t.constn_area = t2.area_no and
		   t.pip_iso_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   t.rev_no = t2.rev_no
		left outer join #ttiso_temp t3
		on t.constn_area = t3.area_no and
		   t.pip_iso_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no
		where t2.plant_no = ''1240'' and
		      t2.drawing_no is null and
		      t3.plant_no = ''1240'';
		
	update t 
		set t.rev_no = isnull(t3.rev_no, t2.rev_no),
		    t.stat = ''Active'',
		    t.tot_lm = t.tot_lm + t2.total_length,
		    t.lbsb = t2.iso_lb_sb,
		    t.priority_code = t2.priority_no,
		    t.priority_timing = t2.priority_timing,
		    t.area_loc = t2.area_desc,
		    t.piping_class = t2.piping_class,
		    t.insulation_thickness = CONVERT(decimal,t.insulation_thickness) + (t2.insul_lm_untraced + t2.insul_lm_traced),
		    t.loguser = t2.loguser,
		    t.logdate = t2.logdate,
		    t.logupdate = t2.logupdate
		from piping.dbo.iso t
		inner join dbo.pip_mto_data t2
		on t.area_no = t2.constn_area and
		   t.drawing_no = t2.pip_iso_no and
		   t.sheet_no = t2.sheet_no and
		   t.rev_no = t2.rev_no
		left outer join #ttiso_temp t3
		on t2.constn_area = t3.area_no and
		   t2.pip_iso_no = t3.drawing_no and
		   t2.sheet_no = t3.sheet_no
		where t3.plant_no = ''1240'';
		
	insert into piping.dbo.spool(plant_no, area_no, drawing_no, sheet_no, rev_no, lbsb, spool_no, spool_id, weld_loc, spl_type, lengg, iso_stat, tot_lm, system_no, sub_system, testpack_no, mat_type, paint_reqd)
	select ''1240'', t.constn_area, t.pip_iso_no, t.sheet_no, ISNULL(t3.rev_no,t.rev_no), t.lb_sb, ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else t.spool_no1 end)), t.spool_no, (case when(CHARINDEX(''FAB'',UPPER(t.mat_location),1) = 1 OR CHARINDEX(''SHOP'',UPPER(t.mat_location),1) = 1) then 1 else 0 end), ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else ''Spool'' end)), 1, ''Active'', t.total_length, SUBSTRING(ltrim(rtrim(t.tp_no)),1,3), SUBSTRING(ltrim(rtrim(t.tp_no)),1,7), t.tp_no, isnull(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else t.spool_category end)), ISNULL(t.painting_specs,(case when(t.painting_specs = '''') then 0 else 1 end))
		from dbo.pip_mto_data t
		left outer join piping.dbo.spool t2
		on t.constn_area = t2.area_no and
		   t.pip_iso_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   t.rev_no = t2.rev_no and
		   ISNULL(t.spool_no1,(case when(t.spool_no1 = '''') then ''EM'' else t.spool_no1 end)) = t2.spool_no
		left outer join #ttiso_temp t3
		on t.constn_area = t3.area_no and
		   t.pip_iso_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no
		where t2.plant_no = ''1240'' and
		      t2.drawing_no is null and
		      t3.plant_no = ''1240'';
		      
	update t
		set t.rev_no = ISNULL(t3.rev_no,t2.rev_no),
			t.stat = ''Active'',
			t.tot_lm = t.tot_lm + t2.total_length,
			t.system_no = SUBSTRING(ltrim(rtrim(t2.tp_no)),1,3),
			t.sub_system = SUBSTRING(ltrim(rtrim(t2.tp_no)),1,7),
			t.testpack_no = t2.tp_no
		from piping.dbo.spool t
		inner join dbo.pip_mto_data t2
		on t.area_no = t2.constn_area and
		   t.drawing_no = t2.pip_iso_no and
		   t.sheet_no = t2.sheet_no and
		   t.rev_no = t2.rev_no and
		   t.spool_no = ISNULL(t2.spool_no1,(case when(t2.spool_no1 = '''') then ''EM'' else t2.spool_no1 end))
		left outer join #ttiso_temp t3
		on t2.constn_area = t3.area_no and
		   t2.pip_iso_no = t3.drawing_no and
		   t2.sheet_no = t3.sheet_no
		where t.plant_no = ''1240'' and
			  t3.plant_no = ''1240'';
    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[isoFabSpl_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[isoFabSpl_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[isoFabSpl_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;
	
	-- proc_internal_clr
	update dbo.pip_fabspl_data set fab = 0;
	update dbo.ttsys set total_spl_qc_f = 0, total_spl_qc_f_dia = 0, total_spl_qc_f_dia_lb = 0, total_spl_qc_f_dia_sb = 0, total_spl_qc_f_lm = 0, total_spl_qc_f_lm_lb = 0, total_spl_qc_f_lm_sb = 0;
	update dbo.ttsys_ag set total_spl_qc_f = 0, total_spl_qc_f_dia = 0, total_spl_qc_f_dia_lb = 0, total_spl_qc_f_dia_sb = 0, total_spl_qc_f_lm = 0, total_spl_qc_f_lm_lb = 0, total_spl_qc_f_lm_sb = 0;
	update dbo.ttsys_ug set total_spl_qc_f = 0, total_spl_qc_f_dia = 0, total_spl_qc_f_dia_lb = 0, total_spl_qc_f_dia_sb = 0, total_spl_qc_f_lm = 0, total_spl_qc_f_lm_lb = 0, total_spl_qc_f_lm_sb = 0;
	update dbo.ttmngtsumm set total_spl_qc_f = 0, total_spl_qc_f_dia = 0, total_spl_qc_f_dia_lb = 0, total_spl_qc_f_dia_sb = 0, total_spl_qc_f_lm = 0, total_spl_qc_f_lm_lb = 0, total_spl_qc_f_lm_sb = 0;
	update dbo.ttmngtsumm_ag set total_spl_qc_f = 0, total_spl_qc_f_dia = 0, total_spl_qc_f_dia_lb = 0, total_spl_qc_f_dia_sb = 0, total_spl_qc_f_lm = 0, total_spl_qc_f_lm_lb = 0, total_spl_qc_f_lm_sb = 0;
	update dbo.ttmngtsumm_ug set total_spl_qc_f = 0, total_spl_qc_f_dia = 0, total_spl_qc_f_dia_lb = 0, total_spl_qc_f_dia_sb = 0, total_spl_qc_f_lm = 0, total_spl_qc_f_lm_lb = 0, total_spl_qc_f_lm_sb = 0;
	update dbo.tttestpack set fab_spl_qty = 0;
	update dbo.ttconstn set fab_spl_qty = 0, fab_spl_qty_lb = 0, fab_spl_qty_sb = 0;
	
	update dbo.ttspl set fabricated = 0, fog_workable = 0;
	
	declare @spool_no1 varchar(max)
	declare @pip_iso_no varchar(max)
	declare @spool_no varchar(max)
	declare @qc_release_date date
	declare @qc_release_no varchar(max)
	declare @weld_total_dia decimal
	declare @sys_no varchar(max)
	declare @linear_total_lm decimal
	declare @lb_sb varchar(max)
	declare @piping_class varchar(max)
	declare @PROGRESS_RECID bigint
	declare @sheet_no varchar(max)
	declare @priority_no varchar(max)
	declare @priority_timing varchar(max)
	declare @constn_unit varchar(max)
	declare @unit_area varchar(max)
	declare crs cursor read_only
		for select spool_no1, pip_iso_no, spool_no, qc_release_date, qc_release_no, weld_total_dia, sys_no, linear_total_lm, lb_sb, piping_class, PROGRESS_RECID, sheet_no, priority_no, priority_timing, constn_unit, unit_area from dbo.ttspl
				
	open crs
	fetch next from crs into @spool_no1, @pip_iso_no, @spool_no, @qc_release_date, @qc_release_no, @weld_total_dia, @sys_no, @linear_total_lm, @lb_sb, @piping_class, @PROGRESS_RECID, @sheet_no, @priority_no, @priority_timing, @constn_unit, @unit_area
	while @@FETCH_STATUS = 0
	begin
		
		if (@spool_no1 != '''')
		begin			
			declare @event int = 0
			declare @fabspl_fab_spl_date date
			--declare @fspl_release_date date
			--declare @fspl_qc_release_date date
			--declare @fspl_qc_release_no varchar(max)
			--declare @fspl_qc_fwhse_recvd_date date
			--declare @fspl_fwhse_pntg_recvd_date date
			--declare @fspl_pntg_blasting_date date
			--declare @fspl_pntg_primer_date date
			--declare @fspl_pntg_release_no date
			--declare @fspl_pntg_release_date date
			--declare @fspl_pntg_intermediate_date date
			--declare @fspl_pntg_painted_date date
			update t set fab = 1, @event = t.fab, @fabspl_fab_spl_date = t.fab_spl_date
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.pip_fabspl_data tp where tp.piping_class = @piping_class and tp.pip_iso_no = @pip_iso_no and tp.spool_no = @spool_no and tp.sheet_no = @sheet_no) t
				where t.Rn = 1
				
			if (@event = 1)
			begin
				if (@fabspl_fab_spl_date is not null)
				begin
					update t set fabricated = 1, fog_workable = 1
						from dbo.ttspl t where t.PROGRESS_RECID = @PROGRESS_RECID
						
					update t set fab_spl_qty = (fab_spl_qty + 1), fab_spl_qty_lb = (case when (@lb_sb = ''LB'') then (t.fab_spl_qty_lb + 1) else t.fab_spl_qty_lb end), fab_spl_qty_sb = (case when (@lb_sb = ''SB'') then (t.fab_spl_qty_sb + 1) else t.fab_spl_qty_sb end)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttconstn tp where tp.piping_class = @piping_class and tp.priority_no = @priority_no and tp.priority_timing = @priority_timing and tp.constn_unit = @constn_unit and tp.unit_area = @unit_area) t
						where t.Rn = 1
						
					update t set total_spl_qc_f = (t.total_spl_qc_f + 1), total_spl_qc_f_dia = (t.total_spl_qc_f_dia + @weld_total_dia), total_spl_qc_f_dia_lb = (t.total_spl_qc_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), total_spl_qc_f_dia_sb = (t.total_spl_qc_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)),
						total_spl_qc_f_lm = (t.total_spl_qc_f_lm + @linear_total_lm), total_spl_qc_f_lm_lb = (t.total_spl_qc_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)), total_spl_qc_f_lm_sb = (t.total_spl_qc_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys tp where tp.sys_no = @sys_no) t
						where t.Rn = 1
						
					update t set total_spl_qc_f = (t.total_spl_qc_f + 1), total_spl_qc_f_dia = (t.total_spl_qc_f_dia + @weld_total_dia), total_spl_qc_f_dia_lb = (t.total_spl_qc_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), total_spl_qc_f_dia_sb = (t.total_spl_qc_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)),
						total_spl_qc_f_lm = (t.total_spl_qc_f_lm + @linear_total_lm), total_spl_qc_f_lm_lb = (t.total_spl_qc_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)), total_spl_qc_f_lm_sb = (t.total_spl_qc_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ag tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
						where t.Rn = 1
						
					update t set total_spl_qc_f = (t.total_spl_qc_f + 1), total_spl_qc_f_dia = (t.total_spl_qc_f_dia + @weld_total_dia), total_spl_qc_f_dia_lb = (t.total_spl_qc_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), total_spl_qc_f_dia_sb = (t.total_spl_qc_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)),
						total_spl_qc_f_lm = (t.total_spl_qc_f_lm + @linear_total_lm), total_spl_qc_f_lm_lb = (t.total_spl_qc_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)), total_spl_qc_f_lm_sb = (t.total_spl_qc_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ug tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
						where t.Rn = 1
						
					update t set total_spl_qc_f = (t.total_spl_qc_f + 1), total_spl_qc_f_dia = (t.total_spl_qc_f_dia + @weld_total_dia), total_spl_qc_f_dia_lb = (t.total_spl_qc_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), total_spl_qc_f_dia_sb = (t.total_spl_qc_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)),
						total_spl_qc_f_lm = (t.total_spl_qc_f_lm + @linear_total_lm), total_spl_qc_f_lm_lb = (t.total_spl_qc_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)), total_spl_qc_f_lm_sb = (t.total_spl_qc_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
						
					update t set total_spl_qc_f = (t.total_spl_qc_f + 1), total_spl_qc_f_dia = (t.total_spl_qc_f_dia + @weld_total_dia), total_spl_qc_f_dia_lb = (t.total_spl_qc_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), total_spl_qc_f_dia_sb = (t.total_spl_qc_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)),
						total_spl_qc_f_lm = (t.total_spl_qc_f_lm + @linear_total_lm), total_spl_qc_f_lm_lb = (t.total_spl_qc_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)), total_spl_qc_f_lm_sb = (t.total_spl_qc_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp where tp.piping_class = @piping_class) t
						where t.Rn = 1
						
					update t set total_spl_qc_f = (t.total_spl_qc_f + 1), total_spl_qc_f_dia = (t.total_spl_qc_f_dia + @weld_total_dia), total_spl_qc_f_dia_lb = (t.total_spl_qc_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), total_spl_qc_f_dia_sb = (t.total_spl_qc_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)),
						total_spl_qc_f_lm = (t.total_spl_qc_f_lm + @linear_total_lm), total_spl_qc_f_lm_lb = (t.total_spl_qc_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)), total_spl_qc_f_lm_sb = (t.total_spl_qc_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp where tp.piping_class = @piping_class) t
						where t.Rn = 1
				end
			end
		end
		
		fetch next from crs into @spool_no1, @pip_iso_no, @spool_no, @qc_release_date, @qc_release_no, @weld_total_dia, @sys_no, @linear_total_lm, @lb_sb, @piping_class, @PROGRESS_RECID, @sheet_no, @priority_no, @priority_timing, @constn_unit, @unit_area
	end
	close crs
	deallocate crs
	
	-- proc_internal_tbl1		
	
	update dbo.tttpspl set fabricated = 0;

	declare @tp_no varchar(max)
	select @spool_no1 = '''', @piping_class = '''', @pip_iso_no = '''', @sheet_no = '''', @spool_no = '''', @PROGRESS_RECID = 0;
	declare crs_tt cursor read_only
		for select spool_no1, piping_class, pip_iso_no, sheet_no, spool_no, PROGRESS_RECID, tp_no from dbo.tttpspl
				
	open crs_tt
	fetch next from crs_tt into @spool_no1, @piping_class, @pip_iso_no, @sheet_no, @spool_no, @PROGRESS_RECID, @tp_no
	while @@FETCH_STATUS = 0
	begin
		if (@spool_no1 != '''')
		begin
			select @event = 0, @fabspl_fab_spl_date = null;
			update t set @event = 1, @fabspl_fab_spl_date = t.fab_spl_date
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.pip_fabspl_data tp where tp.piping_class = @piping_class and tp.pip_iso_no = @pip_iso_no and tp.sheet_no = @sheet_no and tp.spool_no = @spool_no) t
				where t.Rn = 1
								
			if (@event = 1)
			begin
				if (@fabspl_fab_spl_date is not null)
				begin
					update t set fabricated = 1
						from dbo.tttpspl t where t.PROGRESS_RECID = @PROGRESS_RECID
						
					update t set fab_spl_qty = (t.fab_spl_qty + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no) t
						where t.Rn = 1
				end
			end
		end
		
		fetch next from crs_tt into @spool_no1, @piping_class, @pip_iso_no, @sheet_no, @spool_no, @PROGRESS_RECID, @tp_no
	end
	close crs_tt
	deallocate crs_tt
	
	update t set maintenance = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
		where t.Rn = 1
    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[pmWm_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[pmWm_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[pmWm_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	begin transaction;
	
	-- proc_internal_clr
	update dbo.pip_wmatl_data set whse = 0;
	update dbo.ttmatl_s set fab_workable = 0;
	update dbo.ttmatl_e set fog_workable = 0;
	update dbo.ttspl set workable = 0;
	update dbo.ttiso set matl_workable = 0, fab_workable = 0, fog_workable = 0;

	update t set t.fab_workable = 1
		from dbo.ttmatl_s t inner join dbo.pip_wmatl_data t2
		on (t.pip_iso_no1 = t2.pip_iso_no or
			t.pip_iso_no1 = t2.pip_iso_no1) and
			t.spool_no1 = t2.spool_no1 and
			t.item_code = t2.item_code and
			t.size = t2.size
			
	update t set t.whse = 1
		from dbo.pip_wmatl_data t inner join dbo.ttmatl_s t2
		on (t2.pip_iso_no = t.pip_iso_no1 or
			t2.pip_iso_no1 = t.pip_iso_no1) and
			t2.spool_no1 = t.spool_no1 and
			t2.item_code = t.item_code and
			t2.size = t.size
			
	update t set t.fog_workable = 1
		from dbo.ttmatl_e t inner join dbo.pip_wmatl_data t2
		on (t.pip_iso_no1 = t2.pip_iso_no or
			t.pip_iso_no1 = t2.pip_iso_no1) and
			t.item_code = t2.item_code and
			t.size = t2.size
		where (t2.spool_no1 = ''EM'' or
			   t2.spool_no1 = ''ERECTION'')
				
	update t set t.whse = 1
		from dbo.pip_wmatl_data t inner join dbo.ttmatl_e t2
		on (t2.pip_iso_no1 = t.pip_iso_no or
			t2.pip_iso_no1 = t.pip_iso_no1) and
			t2.item_code = t.item_code and
			t2.size = t.size
		where (t.spool_no1 = ''EM'' or
			   t.spool_no1 = ''ERECTION'')
			   
	update t set workable = 1
		from dbo.ttspl t inner join dbo.ttmatl_s t2
		on t.piping_class = t2.piping_class and
		   t.constn_area = t2.constn_area and
		   t.pip_iso_no = t2.pip_iso_no1 and
		   t.sheet_no = t2.sheet_no and
		   t.rev_no = t2.rev_no and
		   t.spool_no = t2.spool_no
		where (
			select COUNT(*) as total from dbo.ttmatl_s t3 where t3.piping_class = t.piping_class and t3.constn_area = t.constn_area and t3.pip_iso_no1 = t.pip_iso_no and t3.sheet_no = t.sheet_no and t3.rev_no = t.rev_no and t3.spool_no = t.spool_no
		) = (
			select COUNT(*) as total from dbo.ttmatl_s t3 where t3.piping_class = t.piping_class and t3.constn_area = t.constn_area and t3.pip_iso_no1 = t.pip_iso_no and t3.sheet_no = t.sheet_no and t3.rev_no = t.rev_no and t3.spool_no = t.spool_no and t3.fab_workable = 1
		)
			   
	update dbo.ttiso set fab_workable = 0;
	update t set fab_workable = 1
		from dbo.ttiso t inner join dbo.ttspl t2
		on t.piping_class = t2.piping_class and
		   t.constn_area = t2.constn_area and
		   t.pip_iso_no = t2.pip_iso_no and
		   t.sheet_no = t2.sheet_no and
		   t.rev_no = t2.rev_no
		where (
			select COUNT(*) as total from dbo.ttspl t3 where t3.piping_class = t.piping_class and t3.constn_area = t.constn_area and t3.pip_iso_no = t.pip_iso_no and t3.sheet_no = t.sheet_no and t3.rev_no = t.rev_no
		) > 0 and (
			select COUNT(*) as total from dbo.ttspl t3 where t3.piping_class = t.piping_class and t3.constn_area = t.constn_area and t3.pip_iso_no = t.pip_iso_no and t3.sheet_no = t.sheet_no and t3.rev_no = t.rev_no
		) = (
			select COUNT(*) as total from dbo.ttspl t3 where t3.piping_class = t.piping_class and t3.constn_area = t.constn_area and t3.pip_iso_no = t.pip_iso_no and t3.sheet_no = t.sheet_no and t3.rev_no = t.rev_no and t3.fabricated = 1
		)
	update t set matl_workable = 1, fog_workable = 1
		from dbo.ttiso t inner join dbo.ttmatl_e t2
		on t.piping_class = t2.piping_class and
		   t.constn_area = t2.constn_area and
		   t.pip_iso_no = t2.pip_iso_no1 and
		   t.sheet_no = t2.sheet_no and
		   t.rev_no = t2.rev_no
		where (
			select COUNT(*) as total from dbo.ttmatl_e t3 where t3.piping_class = t.piping_class and t3.constn_area = t.constn_area and t3.pip_iso_no = t.pip_iso_no and t3.sheet_no = t.sheet_no and t3.rev_no = t.rev_no
		) > 0 and (
			select COUNT(*) as total from dbo.ttmatl_e t3 where t3.piping_class = t.piping_class and t3.constn_area = t.constn_area and t3.pip_iso_no = t.pip_iso_no and t3.sheet_no = t.sheet_no and t3.rev_no = t.rev_no
		) = (
			select COUNT(*) as total from dbo.ttmatl_e t3 where t3.piping_class = t.piping_class and t3.constn_area = t.constn_area and t3.pip_iso_no = t.pip_iso_no and t3.sheet_no = t.sheet_no and t3.rev_no = t.rev_no and t3.fog_workable = 1
		)

    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[pipingWeld_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[pipingWeld_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[pipingWeld_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	BEGIN TRANSACTION;

	DELETE FROM piping.dbo.joints;
	DELETE FROM piping.dbo.tra_joints_pip;
	DELETE FROM piping.dbo.h_joints;
	DELETE FROM piping.dbo.h_tra_joints_pip;
	
	with this_query as (
		select * from dbo.pip_weld_data as t where t.size != '''' and (CHARINDEX(''DEL'',t.size,1) != 1) and (CHARINDEX(''/'',t.size,1) = 0)
	)
	merge piping.dbo.joints as target
	using (select t2.constn_area, t2.pip_iso_no, t2.sheet_no, t2.rev_no,
			case when (t2.spool_no1 != '''') then t2.spool_no1 else ''EM'' end,
			t2.joint_no, t2.size, case when (CHARINDEX(''FAB'',t2.weld_location,1) != 1 or CHARINDEX(''SHOP'',t2.weld_location,1) != 1) then 1 else 0 end, t2.lb_sb from this_query as t2) as src
		  (constn_area, pip_iso_no, sheet_no, rev_no, spool_no1, joint_no, size, weld_location, lb_sb)
	on (
		target.plant_no = ''1240'' and
		target.area_no = src.constn_area and
		target.drawing_no = src.pip_iso_no and
		target.sheet_no = src.sheet_no and
		target.spool_no = src.spool_no1 and
		target.joint_no = src.joint_no
	)
	when matched then
		update set rev_no = src.rev_no, stat = ''Active'', lbsb = src.lb_sb
	when not matched then
		insert (plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, joint_no, size, diainch, weld_loc, lbsb)
		values (''1240'',src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.spool_no1, src.joint_no, src.size,
			convert(decimal(17,2),src.size), src.weld_location, src.lb_sb);
			
	with this_query as (
		select * from dbo.pip_weld_data as t where t.size != '''' and (CHARINDEX(''DEL'',t.size,1) != 1) and (CHARINDEX(''/'',t.size,1) = 0)
	)	
	merge piping.dbo.tra_joints_pip as target
	using (select t2.constn_area, t2.pip_iso_no, t2.sheet_no, t2.rev_no,
			case when (t2.spool_no1 != '''') then t2.spool_no1 else '''' end,
			t2.joint_no, t2.size, case when (CHARINDEX(''FAB'',t2.weld_location,1) != 1 or CHARINDEX(''SHOP'',t2.weld_location,1) != 1) then 1 else 0 end,
			case when (t2.lb_sb = ''LB'') then 1 else 0 end, t2.spool_no from this_query as t2) as src
		  (constn_area, pip_iso_no, sheet_no, rev_no, spool_no1, joint_no, size, weld_location, lb_sb, spool_no)
	on (
		target.plant_no = ''1240'' and
		target.area_no = src.constn_area and
		target.drawing_no = src.pip_iso_no and
		target.sheet_no = src.sheet_no and
		target.revision = src.rev_no and
		target.spool_no = src.spool_no1 and
		target.joint_no = src.joint_no
	)
	when matched then
		update set revision = src.rev_no, stat = ''Active'', bore_size = src.lb_sb
	when not matched then
		insert (plant_no, area_no, drawing_no, sheet_no, revision, spool_no, joint_no, size, weld_loc, bore_size, spl_dwg)
		values (''1240'',src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.spool_no1, src.joint_no, src.size,
			src.weld_location, src.lb_sb,
			case when (src.spool_no1 != '''') then (src.pip_iso_no + ''-'' + src.spool_no) else '''' end);
	
	insert into piping.dbo.h_joints
		select * from piping.dbo.joints as t where t.stat = ''In-Active'';
	delete from piping.dbo.joints where stat = ''In-Active'';
	
	insert into piping.dbo.h_tra_joints_pip
		select * from piping.dbo.tra_joints_pip as t where t.stat = ''In-Active'';
	delete from piping.dbo.tra_joints_pip where stat = ''In-Active'';
	
	update piping.dbo.spool set sw_diainch = (case when (t.spool_no = ''EM'') then 0 else t.dcTotSplDia end)
		from (select sum(diainch) as dcTotSplDia, plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no 
				from piping.dbo.joints 
				group by plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no) as t
		where piping.dbo.spool.plant_no = t.plant_no and piping.dbo.spool.area_no = t.area_no and
			  piping.dbo.spool.drawing_no = t.drawing_no and piping.dbo.spool.sheet_no = t.sheet_no and
			  piping.dbo.spool.rev_no = t.rev_no and piping.dbo.spool.spool_no = t.spool_no
			  
	update piping.dbo.iso set total_em = (case when (t.spool_no = ''EM'') then t.dcTotEM else 0 end),
		total_emdia = t.dcTotEMDia, tot_spl = t.dcTotSpl,
		tot_spldia = (case when (t.spool_no != ''EM'') then t.dcTotSplDia else 0 end)
		from (select sum(diainch) as dcTotSplDia, sum(diainch) as dcTotEMDia,
				dcTotEM = + (case when (spool_no = ''EM'') then 1 else 0 end),
				dcTotSpl = + (case when (spool_no != ''EM'') then 1 else 0 end), plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no 
				from piping.dbo.joints 
				group by plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no) as t
		where piping.dbo.iso.plant_no = t.plant_no and piping.dbo.iso.area_no = t.area_no and
			  piping.dbo.iso.drawing_no = t.drawing_no and piping.dbo.iso.sheet_no = t.sheet_no and
			  piping.dbo.iso.rev_no = t.rev_no	

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1		  
	
    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[pipingMTO_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[pipingMTO_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[pipingMTO_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	--@result int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	BEGIN TRANSACTION;
    -- Insert statements for procedure here
	UPDATE piping.dbo.mat_takeoff_perspool SET stat = ''In-Active'';
	UPDATE piping.dbo.spool SET stat = ''In-Active'', tot_lm = 0;
	UPDATE piping.dbo.iso SET stat = ''In-Active'', tot_lm = 0;
	
	DELETE FROM piping.dbo.h_mat_takeoff_perspool;
	DELETE FROM piping.dbo.h_spool;
	DELETE FROM piping.dbo.h_iso;

	insert piping.dbo.testpack_hdr(testpack_no,system_no,sub_system,tp_type,serv_line,pid,scope,test_pressure) 
		select t.tp_no,SUBSTRING(t.tp_no,1,3),SUBSTRING(t.tp_no,1,7),t.tp_type_of_test,t.serv_line_desc,t.p_id,''ARCC'',case when (isNumeric(t.test_pressure) = 1) then convert(decimal(17,2),t.test_pressure) else 0.00 end
		from dbo.pip_mto_data as t where t.tp_no not in (select t2.testpack_no from piping.dbo.testpack_hdr as t2);

	insert piping.dbo.system(system_no, system_desc) 
		select SUBSTRING(t.tp_no,1,3),SUBSTRING(t.tp_no,1,3)
		from dbo.pip_mto_data as t where SUBSTRING(t.tp_no,1,3) not in (select t2.system_no from piping.dbo.system as t2);
					
	insert piping.dbo.material_file(stock_no,item_code,description,unit,uom,size,commodity_code,schedule,mat_type,item,log_user,log_date)
		select t.item_code,t.item_code,t.mat_description, case when (t.group_1 = ''PIPE'') then ''M'' else ''PC'' end,
			case when (t.group_1 = ''PIPE'') then ''M'' else ''PC'' end,t.size,t.item_code,t.schedule_1,t.group_1,t.group_2,
			''UPLOADED'',{fn NOW()}
			from dbo.pip_mto_data as t left outer join piping.dbo.mat_takeoff_perspool as t2 on t2.plant_no = ''1240'' and t2.area_no = t.constn_area and t2.drawing_no = t.pip_iso_no and t2.sheet_no = t.sheet_no and t2.spool_no = (case when (t.spool_no1 = '''') then ''EM'' else t.spool_no1 end) and t2.commodity_code = t.item_code and t2.size = t.size and t2.isc_no = t.item_no
			left outer join piping.dbo.material_file as t3 on t3.stock_no = t.item_code and t3.item_code = t.item_code and t3.commodity_code = t.item_code and t3.size = t.size where plant_no is null and t3.stock_no is null			
			
	insert piping.dbo.material_file_dtl(disc_code,disc_desc,stock_no,item_code,commodity_code,size,flg_status,log_user,log_date)
		select ''PIP'',''PIPING'',t.item_code,t.item_code,t.item_code,t.size,1,''UPLOADED'',{fn NOW()}
			from dbo.pip_mto_data as t left outer join piping.dbo.mat_takeoff_perspool as t2 on t2.plant_no = ''1240'' and t2.area_no = t.constn_area and t2.drawing_no = t.pip_iso_no and t2.sheet_no = t.sheet_no and t2.spool_no = (case when (t.spool_no1 = '''') then ''EM'' else t.spool_no1 end) and t2.commodity_code = t.item_code and t2.size = t.size and t2.isc_no = t.item_no
			left outer join piping.dbo.material_file_dtl as t3 on t3.stock_no = t.item_code and t3.item_code = t.item_code and t3.commodity_code = t.item_code and t3.disc_code = ''PIP'' where plant_no is null and t3.stock_no is null
			
	Merge piping.dbo.mat_takeoff_perspool as target
	Using 
		(select t.constn_area,t.pip_iso_no,t.sheet_no,t.rev_no,
		 case when t.spool_no1 = '''' then ''EM'' else t.spool_no1 end,t.item_code,t.item_code,
		 t.qty,t.size,t.total_length,t.group_1,t.group_2,t.item_no,t.tp_no,
		 case when (CHARINDEX(''FAB'',t.mat_location,1) = 0 or CHARINDEX(''SHOP'',t.mat_location,1) = 0) then 1 else 0 end,''sa uploaded'',
		 case when (CHARINDEX(''FAB'',t.mat_location,1) = 0 or CHARINDEX(''SHOP'',t.mat_location,1) = 0) then ''Spool'' else ''EM'' end,''Active'',
		 t.mat_description, case when (t.group_1 = ''PIPE'') then ''M'' else ''PC'' end,t.item_no,t.mat_description from dbo.pip_mto_data t) as src
		(constn_area, pip_iso_no, sheet_no, rev_no, spool_no, item_code, commodity_code, qty, size, length, category, mat_type, isc_no,
		 testpack_no, weld_loc, user_id, spl_type,	stat, mat_desc, uom,item_no,mat_description)	
	on (
		target.plant_no = ''1240'' and 
		target.area_no = src.constn_area and 
		target.drawing_no = src.pip_iso_no and 
		target.sheet_no = src.sheet_no and 
		target.spool_no = src.spool_no and 
		target.commodity_code = src.item_code and 
		target.size = src.size and 
		target.isc_no = src.item_no
	)
	when matched then
		update set rev_no = src.rev_no, stat = ''Active'', mat_desc = src.mat_description, uom = src.uom
	when not matched then
		insert (plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, item_code, commodity_code, qty, size, length, category, mat_type, isc_no,
			date_posted, testpack_no, weld_loc, user_id, spl_type,	stat, mat_desc, uom) 
		values(''1240'', src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.spool_no, src.item_code, src.commodity_code, src.qty, src.size,
			src.length, src.category, src.mat_type, src.isc_no, CONVERT(VARCHAR(10),GETDATE(),111), src.testpack_no, src.weld_loc, src.user_id, src.spl_type, stat,
			src.mat_desc,src.uom);
			
	Merge piping.dbo.iso as target
	Using 
		(select t.constn_area,t.pip_iso_no,t.sheet_no,t.rev_no,
		 case when t.spool_no1 = '''' then ''EM'' else ''FAB'' end,t.spool_no1,t.iso_lb_sb,t.line_no,t.line_class,
		 t.painting_specs,t.insul_type,t.serv_line_code,t.total_length,t.tp_no,t.priority_no,t.priority_timing,
		 t.area_desc,t.piping_class from dbo.pip_mto_data t) as src
		(constn_area,pip_iso_no,sheet_no,rev_no,spool_no,spool_no1,iso_lb_sb,line_no,line_class,
		 painting_specs,insul_type,serv_line_code,total_length,tp_no,priority_no,priority_timing,
		 area_desc,piping_class)	
	on (
		target.plant_no = ''1240'' and 
		target.area_no = src.constn_area and 
		target.drawing_no = src.pip_iso_no and 
		target.sheet_no = src.sheet_no
	)
	when matched then
		update set rev_no = src.rev_no, stat = ''Active'', tot_lm = (tot_lm + src.total_length), lbsb = src.iso_lb_sb, priority_code = src.priority_no, 
			priority_timing = src.priority_timing, area_loc = src.area_desc, piping_class = src.piping_class, 
			matl = (
				case 
					when (matl = '''') then 
						(case when (src.spool_no1 = '''') then
								''EM'' 
							  else 
								''FAB'' end)
					else 
						(case when (src.spool_no1 != '''') then 
							(case when (matl = ''EM'') then 
								''FAB'' 
							 else 
								matl end) 
						 else matl end)
					end)			
	when not matched then
		insert (discipline, plant_no, area_no, drawing_no, sheet_no, rev_no, lbsb, line_no, lineclass, painting, insulation, fluid_code,
			stat, tot_lm, systemto, priority_code, priority_timing, area_loc, piping_class, matl) 
		values(''1240-Piping'', ''1240'', src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.iso_lb_sb, src.line_no, src.line_class,
			src.painting_specs, src.insul_type, src.serv_line_code, ''Active'', src.total_length, src.tp_no, src.priority_no, src.priority_timing,
			src.area_desc, src.piping_class, src.spool_no);
			
	Merge piping.dbo.spool as target
	Using 
		(select t.constn_area,t.pip_iso_no,t.sheet_no,t.rev_no,
		 case when t.spool_no1 = '''' then ''EM'' else t.spool_no1 end,t.lb_sb,t.spool_no,
		 case when (CHARINDEX(''FAB'',t.mat_location,1) = 0 or CHARINDEX(''SHOP'',t.mat_location,1) = 0) then 1 else 0 end,
		 case when t.spool_no1 = '''' then ''EM'' else ''Spool'' end,t.total_length,
		 t.tp_no,case when t.spool_no1 != '''' then t.spool_category else ''EM'' end,
		 case when t.painting_specs != '''' then 1 else 0 end,t.spool_category from dbo.pip_mto_data t) as src
		(constn_area,pip_iso_no,sheet_no,rev_no,spool_no1,lb_sb,spool_no,mat_location,
		 spool_no1a,total_length,tp_no,spool_no1b,painting_specs,spool_category)	
	on (
		target.plant_no = ''1240'' and 
		target.area_no = src.constn_area and 
		target.drawing_no = src.pip_iso_no and 
		target.sheet_no = src.sheet_no and 
		target.rev_no = src.rev_no and
		target.spool_no = src.spool_no1
	)
	when matched then
		update set rev_no = src.rev_no, stat = ''Active'', tot_lm = (tot_lm + src.total_length), system_no = substring(src.tp_no,1,3),
			sub_system = substring(src.tp_no,1,7), testpack_no = src.tp_no,
			lbsb = (
				case 
					when (src.lb_sb = ''LB'') then 
						(case when (lbsb = ''SB'') then
								src.lb_sb
							  else 
								lbsb end)
					else 
						lbsb end),
			mat_type = (
				case 
					when (src.spool_no1 != '''') then
						src.spool_category
					else
						''EM'' end),
			paint_reqd = (
				case 
					when (src.painting_specs != '''') then
						1
					else
						0 end)
	when not matched then
		insert (plant_no, area_no, drawing_no, sheet_no, rev_no, lbsb, spool_no, spool_id, weld_loc, spl_type,
			lengg,iso_stat,tot_lm,system_no,sub_system,testpack_no, mat_type, paint_reqd)
		values(''1240'', src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.lb_sb, src.spool_no1, src.spool_no,
			src.mat_location, src.spool_no1a, 1, ''ACTIVE'', src.total_length, substring(src.tp_no,1,3), substring(src.tp_no,1,7), src.tp_no,
			src.spool_no1b, src.painting_specs);
			
	insert into piping.dbo.h_mat_takeoff_perspool
		select * from piping.dbo.mat_takeoff_perspool as t where t.stat = ''In-Active'';
	delete from piping.dbo.mat_takeoff_perspool where piping.dbo.mat_takeoff_perspool.stat = ''In-Active'';
			
	insert into piping.dbo.h_iso
		select * from piping.dbo.iso as t where t.stat = ''In-Active'';
	delete from piping.dbo.iso where piping.dbo.iso.stat = ''In-Active'';
			
	insert into piping.dbo.h_spool
		select * from piping.dbo.spool as t where t.stat = ''In-Active'';
	delete from piping.dbo.spool where piping.dbo.spool.stat = ''In-Active'';
	
	update t3 set t3.tot_spl = t3.tot_spl + 1
		from (select distinct piping.dbo.spool.spool_no from piping.dbo.spool where piping.dbo.spool.iso_stat = ''Active'') t 
		join piping.dbo.spool t2 on t2.spool_no = t.spool_no 
		join piping.dbo.iso t3 on t3.plant_no = t2.plant_no and
			t3.area_no = t2.area_no and
			t3.drawing_no = t2.drawing_no and
			t3.sheet_no = t2.sheet_no and
			t3.rev_no = t2.rev_no

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END' 
END
GO
/****** Object:  StoredProcedure [dbo].[isoPS1_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[isoPS1_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[isoPS1_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	begin transaction;
	
	update t set total_ps = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
		where t.Rn = 1
	update t set total_ps = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
		where t.Rn = 1
	update t set total_ps = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
		where t.Rn = 1
		
	delete from dbo.ttps;	
	delete from dbo.ttconstn where dbo.ttconstn.logupdate = ''Upload Piping Pipe Support Data'';
	update dbo.ttconstn set ps_qty = 0, ps_qty_lb = 0, ps_qty_sb = 0;

	declare @piping_class varchar(max)
	declare @priority_timing varchar(max)
	declare @priority_no varchar(max)
	declare @field_desc varchar(max)
	declare @area_desc varchar(max)	
	declare @constn_area varchar(max)
	declare @unit_area varchar(max)
	declare @item varchar(max)
	declare @qty_iso int
	declare @pip_iso_no varchar(max)
	declare @lb_sb varchar(max)
	declare @sheet_no varchar(max)
	declare @rev_no varchar(max)
	declare @support_code varchar(max)
	declare @tp_no varchar(max)
	declare @total_wt varchar(max)
	declare crs cursor read_only
		for select piping_class, priority_timing, priority_no, field_desc, area_desc, constn_area, unit_area, item, qty_iso, lb_sb, sheet_no, rev_no, support_code, tp_no
				from dbo.pip_sup_data
				
	open crs
	fetch next from crs into @piping_class, @priority_timing, @priority_no, @field_desc, @area_desc, @constn_area, @unit_area, @item, @qty_iso, @lb_sb, @sheet_no, @rev_no, @support_code, @tp_no
	while @@FETCH_STATUS = 0
	begin
		if (@piping_class != '''')
		begin
			merge dbo.ttpc as target
			using (select @piping_class) as src (piping_class)
			on (target.piping_class = src.piping_class)
			when not matched then
				insert (piping_class, datasource, loguser, logdate, logtime, logupdate)
				values(src.piping_class, ''pip_sup_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Pipe Support Data'');
		end
		if (@priority_no != '''')
		begin
			merge dbo.ttpn as target
			using (select @priority_no) as src (priority_no)
			on (target.priority_no = src.priority_no)
			when not matched then
				insert (priority_no, datasource, loguser, logdate, logtime, logupdate)
				values(src.priority_no, ''pip_sup_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Pipe Support Data'');
		end
		if (@priority_timing != '''')
		begin
			merge dbo.ttpt as target
			using (select @priority_timing) as src (priority_timing)
			on (target.priority_timing = src.priority_timing)
			when not matched then
				insert (priority_timing, datasource, loguser, logdate, logtime, logupdate)
				values(src.priority_timing, ''pip_sup_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Pipe Support Data'');
		end
		if (@field_desc != '''')
		begin
			merge dbo.ttfd as target
			using (select @field_desc) as src (field_desc)
			on (target.field_desc = src.field_desc)
			when not matched then
				insert (field_desc, datasource, loguser, logdate, logtime, logupdate)
				values(src.field_desc, ''pip_sup_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Pipe Support Data'');
		end
		if (@area_desc != '''')
		begin
			merge dbo.ttad as target
			using (select @area_desc) as src (area_desc)
			on (target.area_desc = src.area_desc)
			when not matched then
				insert (area_desc, datasource, loguser, logdate, logtime, logupdate)
				values(src.area_desc, ''pip_sup_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Pipe Support Data'');
		end
		
		merge dbo.ttconstn as target
		using (select @piping_class, @priority_no, @priority_timing, @constn_area, @unit_area, @qty_iso) as src (piping_class, priority_no, priority_timing, constn_area, unit_area, qty_iso)
		on (target.piping_class = src.piping_class and
			target.priority_no = src.priority_no and
			target.priority_timing = src.priority_timing and
			target.constn_unit = src.constn_area and
			target.unit_area = src.unit_area)
		when matched then
			update set ps_qty = (ps_qty + src.qty_iso),
					   ps_qty_lb = (case when (@lb_sb = ''LB'') then (ps_qty_lb + src.qty_iso) else ps_qty_lb end),
					   ps_qty_sb = (case when (@lb_sb = ''SB'') then (ps_qty_sb + src.qty_iso) else ps_qty_sb end)
		when not matched then
			insert (piping_class, priority_no, priority_timing, constn_unit, unit_area, ps_qty, ps_qty_lb, ps_qty_sb, datasource, loguser, logdate, logtime, logupdate)
			values(src.piping_class, src.priority_no, src.priority_timing, src.constn_area, src.unit_area, src.qty_iso, (case when (@lb_sb = ''LB'') then src.qty_iso else 0 end), (case when (@lb_sb = ''SB'') then src.qty_iso else 0 end), ''pip_sup_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Pipe Support Data'');
		
		if (@item = ''1'')
		begin
			merge dbo.ttps as target
			using (select @piping_class, @constn_area, 
				(case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end),
				@sheet_no, @rev_no, @support_code, @qty_iso, @priority_no, @priority_timing, @unit_area, @tp_no) as src 
				(piping_class, constn_area, pip_iso_no, sheet_no, rev_no, support_code, qty_iso, priority_no, priority_timing, unit_area, tp_no)
			on (target.piping_class = src.piping_class and
				target.constn_area = src.constn_area and
				target.pip_iso_no = src.pip_iso_no and
				target.sheet_no = src.sheet_no and
				target.rev_no = src.rev_no and
				target.support_code = src.support_code)
			when matched then
				update set qty_iso = (target.qty_iso + src.qty_iso)
			when not matched then
				insert (piping_class, constn_area, pip_iso_no, sheet_no, rev_no, support_code, qty_iso, priority_no, priority_timing, constn_unit, unit_area, tp_no, um, datasource, loguser, logdate, logtime, logupdate)
				values(src.piping_class, src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.support_code, src.qty_iso, src.priority_no, src.priority_timing, src.constn_area, src.unit_area, src.tp_no, ''Tons'', ''pip_sup_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Pipe Support Data'');
		end
	
		update t set total_ps = (total_ps + @qty_iso)
			from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
			where t.Rn = 1
		update t set total_ps = (total_ps + @qty_iso)
			from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
			where t.Rn = 1
		update t set total_ps = (total_ps + @qty_iso)
			from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
			where t.Rn = 1
		
		fetch next from crs into @piping_class, @priority_timing, @priority_no, @field_desc, @area_desc, @constn_area, @unit_area, @item, @qty_iso, @lb_sb, @sheet_no, @rev_no, @support_code, @tp_no
	end
	close crs
	deallocate crs
	
	declare crs2 cursor read_only
		for select piping_class, priority_timing, priority_no, field_desc, area_desc, constn_area, unit_area, item, qty_iso, lb_sb, sheet_no, rev_no, support_code, tp_no, total_wt
				from dbo.pip_sup_data
				
	open crs2
	fetch next from crs2 into @piping_class, @priority_timing, @priority_no, @field_desc, @area_desc, @constn_area, @unit_area, @item, @qty_iso, @lb_sb, @sheet_no, @rev_no, @support_code, @tp_no, @total_wt
	while @@FETCH_STATUS = 0
	begin		
		merge dbo.ttps as target
		using (select @piping_class, @constn_area, 
			(case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end),
			@sheet_no, @rev_no, @support_code, @qty_iso, @priority_no, @priority_timing, @unit_area, @tp_no, @total_wt) as src 
			(piping_class, constn_area, pip_iso_no, sheet_no, rev_no, support_code, qty_iso, priority_no, priority_timing, unit_area, tp_no, total_wt)
		on (target.piping_class = src.piping_class and
			target.constn_area = src.constn_area and
			target.pip_iso_no = src.pip_iso_no and
			target.sheet_no = src.sheet_no and
			target.rev_no = src.rev_no and
			target.support_code = src.support_code)
		when matched then
			update set total_wt = (target.total_wt + src.total_wt);
				
		fetch next from crs2 into @piping_class, @priority_timing, @priority_no, @field_desc, @area_desc, @constn_area, @unit_area, @item, @qty_iso, @lb_sb, @sheet_no, @rev_no, @support_code, @tp_no, @total_wt
	end
	close crs2
	deallocate crs2
    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[isoWhseSpl_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[isoWhseSpl_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[isoWhseSpl_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;
	
	-- proc_internal_clr
	update dbo.pip_wspl_data set whse = 0;
	update dbo.ttsys set total_spl_whse_rec = 0, total_spl_whse_rel = 0;
	update dbo.ttsys_ag set total_spl_whse_rec = 0, total_spl_whse_rel = 0;
	update dbo.ttsys_ug set total_spl_whse_rec = 0, total_spl_whse_rel = 0;
	update dbo.ttmngtsumm set total_spl_whse_rec = 0, total_spl_whse_rel = 0;
	update dbo.ttmngtsumm_ag set total_spl_whse_rec = 0, total_spl_whse_rel = 0;
	update dbo.ttmngtsumm_ug set total_spl_whse_rec = 0, total_spl_whse_rel = 0;


	declare @spool_no1 varchar(max)
	declare @pip_iso_no varchar(max)
	declare @spool_no varchar(max)
	declare @qc_release_date date
	declare @qc_release_no varchar(max)
	declare @weld_total_dia decimal
	declare @sys_no varchar(max)
	declare @linear_total_lm decimal
	declare @lb_sb varchar(max)
	declare @piping_class varchar(max)
	declare @PROGRESS_RECID bigint
	declare crs cursor read_only
		for select spool_no1, pip_iso_no, spool_no, qc_release_date, qc_release_no, weld_total_dia, sys_no, linear_total_lm, lb_sb, piping_class, PROGRESS_RECID from dbo.ttspl
				
	open crs
	fetch next from crs into @spool_no1, @pip_iso_no, @spool_no, @qc_release_date, @qc_release_no, @weld_total_dia, @sys_no, @linear_total_lm, @lb_sb, @piping_class, @PROGRESS_RECID
	while @@FETCH_STATUS = 0
	begin
		
		declare @event int = 0
		declare @wspl_recvd_date date
		declare @wspl_issued_date date
		if (@spool_no1 != '''')
		begin
			update t set whse = 1, @event = t.whse, @wspl_recvd_date = t.recvd_date, @wspl_issued_date = t.issued_date
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.pip_wspl_data tp where tp.pip_iso_no = @pip_iso_no and tp.spool_no = @spool_no) t
				where t.Rn = 1
				
			if (@event = 1)
			begin
				if (@wspl_recvd_date is not null)
				begin
					update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys tp where tp.sys_no = @sys_no) t
						where t.Rn = 1
					update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ag tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
						where t.Rn = 1
					update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ug tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
						where t.Rn = 1
					update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
					update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp where tp.piping_class = @piping_class) t
						where t.Rn = 1
					update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp where tp.piping_class = @piping_class) t
						where t.Rn = 1
				end
				if (@wspl_issued_date is not null)
				begin
					update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys tp where tp.sys_no = @sys_no) t
						where t.Rn = 1
					update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ag tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
						where t.Rn = 1
					update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ug tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
						where t.Rn = 1
					update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
					update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp where tp.piping_class = @piping_class) t
						where t.Rn = 1
					update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp where tp.piping_class = @piping_class) t
						where t.Rn = 1
				end
			end
			else
			begin
				select @event = 0, @wspl_recvd_date = null, @wspl_issued_date = null;
				update t set whse = 1, @event = t.whse, @wspl_recvd_date = t.recvd_date, @wspl_issued_date = t.issued_date
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.pip_wspl_data tp where tp.pip_iso_no1 = @pip_iso_no and tp.spool_no = @spool_no) t
					where t.Rn = 1
					
				if (@event = 1)
				begin
					if (@wspl_recvd_date is not null)
					begin
						update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys tp where tp.sys_no = @sys_no) t
							where t.Rn = 1
						update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ag tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
							where t.Rn = 1
						update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ug tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
							where t.Rn = 1
						update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
							where t.Rn = 1
						update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp where tp.piping_class = @piping_class) t
							where t.Rn = 1
						update t set total_spl_whse_rec = (t.total_spl_whse_rec + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp where tp.piping_class = @piping_class) t
							where t.Rn = 1
					end
					if (@wspl_issued_date is not null)
					begin
						update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys tp where tp.sys_no = @sys_no) t
							where t.Rn = 1
						update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ag tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
							where t.Rn = 1
						update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ug tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
							where t.Rn = 1
						update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
							where t.Rn = 1
						update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp where tp.piping_class = @piping_class) t
							where t.Rn = 1
						update t set total_spl_whse_rel = (t.total_spl_whse_rel + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp where tp.piping_class = @piping_class) t
							where t.Rn = 1
					end
				end
			end
		end
		
		fetch next from crs into @spool_no1, @pip_iso_no, @spool_no, @qc_release_date, @qc_release_no, @weld_total_dia, @sys_no, @linear_total_lm, @lb_sb, @piping_class, @PROGRESS_RECID
	end
	close crs
	deallocate crs
	
	update t set maintenance = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
		where t.Rn = 1
    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[isoWends_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[isoWends_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[isoWends_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;
	
	update dbo.ttsys set total_spl_qc_s = 0, total_spl_qc_s_dia = 0, total_spl_qc_s_dia_lb = 0, total_spl_qc_s_dia_sb = 0, total_spl_qc_s_lm = 0, total_spl_qc_s_lm_lb = 0, total_spl_qc_s_lm_sb = 0,
						 total_spl_qc_p = 0, total_spl_qc_p_dia = 0, total_spl_qc_p_dia_lb = 0, total_spl_qc_p_dia_sb = 0, total_spl_qc_p_lm = 0, total_spl_qc_p_lm_lb = 0, total_spl_qc_p_lm_sb = 0,
						 total_spl_qc_p_b = 0, total_spl_qc_p_b_dia = 0, total_spl_qc_p_b_dia_lb = 0, total_spl_qc_p_b_dia_sb = 0, total_spl_qc_p_b_lm = 0, total_spl_qc_p_b_lm_lb = 0, total_spl_qc_p_b_lm_sb = 0,
						 total_spl_qc_p_p = 0, total_spl_qc_p_p_dia = 0, total_spl_qc_p_p_dia_lb = 0, total_spl_qc_p_p_dia_sb = 0, total_spl_qc_p_p_lm = 0, total_spl_qc_p_p_lm_lb = 0, total_spl_qc_p_p_lm_sb = 0,
						 total_spl_qc_p_i = 0, total_spl_qc_p_i_dia = 0, total_spl_qc_p_i_dia_lb = 0, total_spl_qc_p_i_dia_sb = 0, total_spl_qc_p_i_lm = 0, total_spl_qc_p_i_lm_lb = 0, total_spl_qc_p_i_lm_sb = 0,
						 total_spl_qc_p_f = 0, total_spl_qc_p_f_dia = 0, total_spl_qc_p_f_dia_lb = 0, total_spl_qc_p_f_dia_sb = 0, total_spl_qc_p_f_lm = 0, total_spl_qc_p_f_lm_lb = 0, total_spl_qc_p_f_lm_sb = 0,
						 total_spl_pntg = 0, total_spl_pntg_dia = 0, total_spl_pntg_dia_lb = 0, total_spl_pntg_dia_sb = 0, total_spl_pntg_lm = 0, total_spl_pntg_lm_lb = 0, total_spl_pntg_lm_sb = 0,
						 total_spl_fog_h = 0, total_spl_fog_h_dia = 0, total_spl_fog_h_dia_lb = 0, total_spl_fog_h_dia_sb = 0, total_spl_fog_h_lm = 0, total_spl_fog_h_lm_lb = 0, total_spl_fog_h_lm_sb = 0,
						 total_spl_fog_ru = 0, total_spl_fog_ru_dia = 0, total_spl_fog_ru_dia_lb = 0, total_spl_fog_ru_dia_sb = 0, total_spl_fog_ru_lm = 0, total_spl_fog_ru_lm_lb = 0, total_spl_fog_ru_lm_sb = 0,
						 total_spl_fog_fu = 0, total_spl_fog_fu_dia = 0, total_spl_fog_fu_dia_lb = 0, total_spl_fog_fu_dia_sb = 0, total_spl_fog_fu_lm = 0, total_spl_fog_fu_lm_lb = 0, total_spl_fog_fu_lm_sb = 0,
						 total_spl_fog_fw = 0, total_spl_fog_fw_dia = 0, total_spl_fog_fw_dia_lb = 0, total_spl_fog_fw_dia_sb = 0, total_spl_fog_fw_lm = 0, total_spl_fog_fw_lm_lb = 0, total_spl_fog_fw_lm_sb = 0,
						 total_spl_fog_p = 0, total_spl_fog_p_dia = 0, total_spl_fog_p_dia_lb = 0, total_spl_fog_p_dia_sb = 0, total_spl_fog_p_lm = 0, total_spl_fog_p_lm_lb = 0, total_spl_fog_p_lm_sb = 0,
						 total_spl_whse_rec = 0, total_spl_whse_rel = 0;
	update dbo.ttsys_ag set total_spl_qc_s = 0, total_spl_qc_s_dia = 0, total_spl_qc_s_dia_lb = 0, total_spl_qc_s_dia_sb = 0, total_spl_qc_s_lm = 0, total_spl_qc_s_lm_lb = 0, total_spl_qc_s_lm_sb = 0,
						 total_spl_qc_p = 0, total_spl_qc_p_dia = 0, total_spl_qc_p_dia_lb = 0, total_spl_qc_p_dia_sb = 0, total_spl_qc_p_lm = 0, total_spl_qc_p_lm_lb = 0, total_spl_qc_p_lm_sb = 0,
						 total_spl_qc_p_b = 0, total_spl_qc_p_b_dia = 0, total_spl_qc_p_b_dia_lb = 0, total_spl_qc_p_b_dia_sb = 0, total_spl_qc_p_b_lm = 0, total_spl_qc_p_b_lm_lb = 0, total_spl_qc_p_b_lm_sb = 0,
						 total_spl_qc_p_p = 0, total_spl_qc_p_p_dia = 0, total_spl_qc_p_p_dia_lb = 0, total_spl_qc_p_p_dia_sb = 0, total_spl_qc_p_p_lm = 0, total_spl_qc_p_p_lm_lb = 0, total_spl_qc_p_p_lm_sb = 0,
						 total_spl_qc_p_i = 0, total_spl_qc_p_i_dia = 0, total_spl_qc_p_i_dia_lb = 0, total_spl_qc_p_i_dia_sb = 0, total_spl_qc_p_i_lm = 0, total_spl_qc_p_i_lm_lb = 0, total_spl_qc_p_i_lm_sb = 0,
						 total_spl_qc_p_f = 0, total_spl_qc_p_f_dia = 0, total_spl_qc_p_f_dia_lb = 0, total_spl_qc_p_f_dia_sb = 0, total_spl_qc_p_f_lm = 0, total_spl_qc_p_f_lm_lb = 0, total_spl_qc_p_f_lm_sb = 0,
						 total_spl_pntg = 0, total_spl_pntg_dia = 0, total_spl_pntg_dia_lb = 0, total_spl_pntg_dia_sb = 0, total_spl_pntg_lm = 0, total_spl_pntg_lm_lb = 0, total_spl_pntg_lm_sb = 0,
						 total_spl_fog_h = 0, total_spl_fog_h_dia = 0, total_spl_fog_h_dia_lb = 0, total_spl_fog_h_dia_sb = 0, total_spl_fog_h_lm = 0, total_spl_fog_h_lm_lb = 0, total_spl_fog_h_lm_sb = 0,
						 total_spl_fog_ru = 0, total_spl_fog_ru_dia = 0, total_spl_fog_ru_dia_lb = 0, total_spl_fog_ru_dia_sb = 0, total_spl_fog_ru_lm = 0, total_spl_fog_ru_lm_lb = 0, total_spl_fog_ru_lm_sb = 0,
						 total_spl_fog_fu = 0, total_spl_fog_fu_dia = 0, total_spl_fog_fu_dia_lb = 0, total_spl_fog_fu_dia_sb = 0, total_spl_fog_fu_lm = 0, total_spl_fog_fu_lm_lb = 0, total_spl_fog_fu_lm_sb = 0,
						 total_spl_fog_fw = 0, total_spl_fog_fw_dia = 0, total_spl_fog_fw_dia_lb = 0, total_spl_fog_fw_dia_sb = 0, total_spl_fog_fw_lm = 0, total_spl_fog_fw_lm_lb = 0, total_spl_fog_fw_lm_sb = 0,
						 total_spl_fog_p = 0, total_spl_fog_p_dia = 0, total_spl_fog_p_dia_lb = 0, total_spl_fog_p_dia_sb = 0, total_spl_fog_p_lm = 0, total_spl_fog_p_lm_lb = 0, total_spl_fog_p_lm_sb = 0,
						 total_spl_whse_rec = 0, total_spl_whse_rel = 0;
	update dbo.ttsys_ug set total_spl_qc_s = 0, total_spl_qc_s_dia = 0, total_spl_qc_s_dia_lb = 0, total_spl_qc_s_dia_sb = 0, total_spl_qc_s_lm = 0, total_spl_qc_s_lm_lb = 0, total_spl_qc_s_lm_sb = 0,
						 total_spl_qc_p = 0, total_spl_qc_p_dia = 0, total_spl_qc_p_dia_lb = 0, total_spl_qc_p_dia_sb = 0, total_spl_qc_p_lm = 0, total_spl_qc_p_lm_lb = 0, total_spl_qc_p_lm_sb = 0,
						 total_spl_qc_p_b = 0, total_spl_qc_p_b_dia = 0, total_spl_qc_p_b_dia_lb = 0, total_spl_qc_p_b_dia_sb = 0, total_spl_qc_p_b_lm = 0, total_spl_qc_p_b_lm_lb = 0, total_spl_qc_p_b_lm_sb = 0,
						 total_spl_qc_p_p = 0, total_spl_qc_p_p_dia = 0, total_spl_qc_p_p_dia_lb = 0, total_spl_qc_p_p_dia_sb = 0, total_spl_qc_p_p_lm = 0, total_spl_qc_p_p_lm_lb = 0, total_spl_qc_p_p_lm_sb = 0,
						 total_spl_qc_p_i = 0, total_spl_qc_p_i_dia = 0, total_spl_qc_p_i_dia_lb = 0, total_spl_qc_p_i_dia_sb = 0, total_spl_qc_p_i_lm = 0, total_spl_qc_p_i_lm_lb = 0, total_spl_qc_p_i_lm_sb = 0,
						 total_spl_qc_p_f = 0, total_spl_qc_p_f_dia = 0, total_spl_qc_p_f_dia_lb = 0, total_spl_qc_p_f_dia_sb = 0, total_spl_qc_p_f_lm = 0, total_spl_qc_p_f_lm_lb = 0, total_spl_qc_p_f_lm_sb = 0,
						 total_spl_pntg = 0, total_spl_pntg_dia = 0, total_spl_pntg_dia_lb = 0, total_spl_pntg_dia_sb = 0, total_spl_pntg_lm = 0, total_spl_pntg_lm_lb = 0, total_spl_pntg_lm_sb = 0,
						 total_spl_fog_h = 0, total_spl_fog_h_dia = 0, total_spl_fog_h_dia_lb = 0, total_spl_fog_h_dia_sb = 0, total_spl_fog_h_lm = 0, total_spl_fog_h_lm_lb = 0, total_spl_fog_h_lm_sb = 0,
						 total_spl_fog_ru = 0, total_spl_fog_ru_dia = 0, total_spl_fog_ru_dia_lb = 0, total_spl_fog_ru_dia_sb = 0, total_spl_fog_ru_lm = 0, total_spl_fog_ru_lm_lb = 0, total_spl_fog_ru_lm_sb = 0,
						 total_spl_fog_fu = 0, total_spl_fog_fu_dia = 0, total_spl_fog_fu_dia_lb = 0, total_spl_fog_fu_dia_sb = 0, total_spl_fog_fu_lm = 0, total_spl_fog_fu_lm_lb = 0, total_spl_fog_fu_lm_sb = 0,
						 total_spl_fog_fw = 0, total_spl_fog_fw_dia = 0, total_spl_fog_fw_dia_lb = 0, total_spl_fog_fw_dia_sb = 0, total_spl_fog_fw_lm = 0, total_spl_fog_fw_lm_lb = 0, total_spl_fog_fw_lm_sb = 0,
						 total_spl_fog_p = 0, total_spl_fog_p_dia = 0, total_spl_fog_p_dia_lb = 0, total_spl_fog_p_dia_sb = 0, total_spl_fog_p_lm = 0, total_spl_fog_p_lm_lb = 0, total_spl_fog_p_lm_sb = 0,
						 total_spl_whse_rec = 0, total_spl_whse_rel = 0;
	update t set total_spl_qc_s = 0, total_spl_qc_s_dia = 0, total_spl_qc_s_dia_lb = 0, total_spl_qc_s_dia_sb = 0, total_spl_qc_s_lm = 0, total_spl_qc_s_lm_lb = 0, total_spl_qc_s_lm_sb = 0,
				 total_spl_qc_p = 0, total_spl_qc_p_dia = 0, total_spl_qc_p_dia_lb = 0, total_spl_qc_p_dia_sb = 0, total_spl_qc_p_lm = 0, total_spl_qc_p_lm_lb = 0, total_spl_qc_p_lm_sb = 0,
				 total_spl_qc_p_b = 0, total_spl_qc_p_b_dia = 0, total_spl_qc_p_b_dia_lb = 0, total_spl_qc_p_b_dia_sb = 0, total_spl_qc_p_b_lm = 0, total_spl_qc_p_b_lm_lb = 0, total_spl_qc_p_b_lm_sb = 0,
				 total_spl_qc_p_p = 0, total_spl_qc_p_p_dia = 0, total_spl_qc_p_p_dia_lb = 0, total_spl_qc_p_p_dia_sb = 0, total_spl_qc_p_p_lm = 0, total_spl_qc_p_p_lm_lb = 0, total_spl_qc_p_p_lm_sb = 0,
				 total_spl_qc_p_i = 0, total_spl_qc_p_i_dia = 0, total_spl_qc_p_i_dia_lb = 0, total_spl_qc_p_i_dia_sb = 0, total_spl_qc_p_i_lm = 0, total_spl_qc_p_i_lm_lb = 0, total_spl_qc_p_i_lm_sb = 0,
				 total_spl_qc_p_f = 0, total_spl_qc_p_f_dia = 0, total_spl_qc_p_f_dia_lb = 0, total_spl_qc_p_f_dia_sb = 0, total_spl_qc_p_f_lm = 0, total_spl_qc_p_f_lm_lb = 0, total_spl_qc_p_f_lm_sb = 0,
				 total_spl_pntg = 0, total_spl_pntg_dia = 0, total_spl_pntg_dia_lb = 0, total_spl_pntg_dia_sb = 0, total_spl_pntg_lm = 0, total_spl_pntg_lm_lb = 0, total_spl_pntg_lm_sb = 0,
				 total_spl_fog_h = 0, total_spl_fog_h_dia = 0, total_spl_fog_h_dia_lb = 0, total_spl_fog_h_dia_sb = 0, total_spl_fog_h_lm = 0, total_spl_fog_h_lm_lb = 0, total_spl_fog_h_lm_sb = 0,
				 total_spl_fog_ru = 0, total_spl_fog_ru_dia = 0, total_spl_fog_ru_dia_lb = 0, total_spl_fog_ru_dia_sb = 0, total_spl_fog_ru_lm = 0, total_spl_fog_ru_lm_lb = 0, total_spl_fog_ru_lm_sb = 0,
				 total_spl_fog_fu = 0, total_spl_fog_fu_dia = 0, total_spl_fog_fu_dia_lb = 0, total_spl_fog_fu_dia_sb = 0, total_spl_fog_fu_lm = 0, total_spl_fog_fu_lm_lb = 0, total_spl_fog_fu_lm_sb = 0,
				 total_spl_fog_fw = 0, total_spl_fog_fw_dia = 0, total_spl_fog_fw_dia_lb = 0, total_spl_fog_fw_dia_sb = 0, total_spl_fog_fw_lm = 0, total_spl_fog_fw_lm_lb = 0, total_spl_fog_fw_lm_sb = 0,
				 total_spl_fog_p = 0, total_spl_fog_p_dia = 0, total_spl_fog_p_dia_lb = 0, total_spl_fog_p_dia_sb = 0, total_spl_fog_p_lm = 0, total_spl_fog_p_lm_lb = 0, total_spl_fog_p_lm_sb = 0,
				 total_spl_whse_rec = 0, total_spl_whse_rel = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
		where t.Rn = 1
	update t set total_spl_qc_s = 0, total_spl_qc_s_dia = 0, total_spl_qc_s_dia_lb = 0, total_spl_qc_s_dia_sb = 0, total_spl_qc_s_lm = 0, total_spl_qc_s_lm_lb = 0, total_spl_qc_s_lm_sb = 0,
				 total_spl_qc_p = 0, total_spl_qc_p_dia = 0, total_spl_qc_p_dia_lb = 0, total_spl_qc_p_dia_sb = 0, total_spl_qc_p_lm = 0, total_spl_qc_p_lm_lb = 0, total_spl_qc_p_lm_sb = 0,
				 total_spl_qc_p_b = 0, total_spl_qc_p_b_dia = 0, total_spl_qc_p_b_dia_lb = 0, total_spl_qc_p_b_dia_sb = 0, total_spl_qc_p_b_lm = 0, total_spl_qc_p_b_lm_lb = 0, total_spl_qc_p_b_lm_sb = 0,
				 total_spl_qc_p_p = 0, total_spl_qc_p_p_dia = 0, total_spl_qc_p_p_dia_lb = 0, total_spl_qc_p_p_dia_sb = 0, total_spl_qc_p_p_lm = 0, total_spl_qc_p_p_lm_lb = 0, total_spl_qc_p_p_lm_sb = 0,
				 total_spl_qc_p_i = 0, total_spl_qc_p_i_dia = 0, total_spl_qc_p_i_dia_lb = 0, total_spl_qc_p_i_dia_sb = 0, total_spl_qc_p_i_lm = 0, total_spl_qc_p_i_lm_lb = 0, total_spl_qc_p_i_lm_sb = 0,
				 total_spl_qc_p_f = 0, total_spl_qc_p_f_dia = 0, total_spl_qc_p_f_dia_lb = 0, total_spl_qc_p_f_dia_sb = 0, total_spl_qc_p_f_lm = 0, total_spl_qc_p_f_lm_lb = 0, total_spl_qc_p_f_lm_sb = 0,
				 total_spl_pntg = 0, total_spl_pntg_dia = 0, total_spl_pntg_dia_lb = 0, total_spl_pntg_dia_sb = 0, total_spl_pntg_lm = 0, total_spl_pntg_lm_lb = 0, total_spl_pntg_lm_sb = 0,
				 total_spl_fog_h = 0, total_spl_fog_h_dia = 0, total_spl_fog_h_dia_lb = 0, total_spl_fog_h_dia_sb = 0, total_spl_fog_h_lm = 0, total_spl_fog_h_lm_lb = 0, total_spl_fog_h_lm_sb = 0,
				 total_spl_fog_ru = 0, total_spl_fog_ru_dia = 0, total_spl_fog_ru_dia_lb = 0, total_spl_fog_ru_dia_sb = 0, total_spl_fog_ru_lm = 0, total_spl_fog_ru_lm_lb = 0, total_spl_fog_ru_lm_sb = 0,
				 total_spl_fog_fu = 0, total_spl_fog_fu_dia = 0, total_spl_fog_fu_dia_lb = 0, total_spl_fog_fu_dia_sb = 0, total_spl_fog_fu_lm = 0, total_spl_fog_fu_lm_lb = 0, total_spl_fog_fu_lm_sb = 0,
				 total_spl_fog_fw = 0, total_spl_fog_fw_dia = 0, total_spl_fog_fw_dia_lb = 0, total_spl_fog_fw_dia_sb = 0, total_spl_fog_fw_lm = 0, total_spl_fog_fw_lm_lb = 0, total_spl_fog_fw_lm_sb = 0,
				 total_spl_fog_p = 0, total_spl_fog_p_dia = 0, total_spl_fog_p_dia_lb = 0, total_spl_fog_p_dia_sb = 0, total_spl_fog_p_lm = 0, total_spl_fog_p_lm_lb = 0, total_spl_fog_p_lm_sb = 0,
				 total_spl_whse_rec = 0, total_spl_whse_rel = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
		where t.Rn = 1
	update t set total_spl_qc_s = 0, total_spl_qc_s_dia = 0, total_spl_qc_s_dia_lb = 0, total_spl_qc_s_dia_sb = 0, total_spl_qc_s_lm = 0, total_spl_qc_s_lm_lb = 0, total_spl_qc_s_lm_sb = 0,
				 total_spl_qc_p = 0, total_spl_qc_p_dia = 0, total_spl_qc_p_dia_lb = 0, total_spl_qc_p_dia_sb = 0, total_spl_qc_p_lm = 0, total_spl_qc_p_lm_lb = 0, total_spl_qc_p_lm_sb = 0,
				 total_spl_qc_p_b = 0, total_spl_qc_p_b_dia = 0, total_spl_qc_p_b_dia_lb = 0, total_spl_qc_p_b_dia_sb = 0, total_spl_qc_p_b_lm = 0, total_spl_qc_p_b_lm_lb = 0, total_spl_qc_p_b_lm_sb = 0,
				 total_spl_qc_p_p = 0, total_spl_qc_p_p_dia = 0, total_spl_qc_p_p_dia_lb = 0, total_spl_qc_p_p_dia_sb = 0, total_spl_qc_p_p_lm = 0, total_spl_qc_p_p_lm_lb = 0, total_spl_qc_p_p_lm_sb = 0,
				 total_spl_qc_p_i = 0, total_spl_qc_p_i_dia = 0, total_spl_qc_p_i_dia_lb = 0, total_spl_qc_p_i_dia_sb = 0, total_spl_qc_p_i_lm = 0, total_spl_qc_p_i_lm_lb = 0, total_spl_qc_p_i_lm_sb = 0,
				 total_spl_qc_p_f = 0, total_spl_qc_p_f_dia = 0, total_spl_qc_p_f_dia_lb = 0, total_spl_qc_p_f_dia_sb = 0, total_spl_qc_p_f_lm = 0, total_spl_qc_p_f_lm_lb = 0, total_spl_qc_p_f_lm_sb = 0,
				 total_spl_pntg = 0, total_spl_pntg_dia = 0, total_spl_pntg_dia_lb = 0, total_spl_pntg_dia_sb = 0, total_spl_pntg_lm = 0, total_spl_pntg_lm_lb = 0, total_spl_pntg_lm_sb = 0,
				 total_spl_fog_h = 0, total_spl_fog_h_dia = 0, total_spl_fog_h_dia_lb = 0, total_spl_fog_h_dia_sb = 0, total_spl_fog_h_lm = 0, total_spl_fog_h_lm_lb = 0, total_spl_fog_h_lm_sb = 0,
				 total_spl_fog_ru = 0, total_spl_fog_ru_dia = 0, total_spl_fog_ru_dia_lb = 0, total_spl_fog_ru_dia_sb = 0, total_spl_fog_ru_lm = 0, total_spl_fog_ru_lm_lb = 0, total_spl_fog_ru_lm_sb = 0,
				 total_spl_fog_fu = 0, total_spl_fog_fu_dia = 0, total_spl_fog_fu_dia_lb = 0, total_spl_fog_fu_dia_sb = 0, total_spl_fog_fu_lm = 0, total_spl_fog_fu_lm_lb = 0, total_spl_fog_fu_lm_sb = 0,
				 total_spl_fog_fw = 0, total_spl_fog_fw_dia = 0, total_spl_fog_fw_dia_lb = 0, total_spl_fog_fw_dia_sb = 0, total_spl_fog_fw_lm = 0, total_spl_fog_fw_lm_lb = 0, total_spl_fog_fw_lm_sb = 0,
				 total_spl_fog_p = 0, total_spl_fog_p_dia = 0, total_spl_fog_p_dia_lb = 0, total_spl_fog_p_dia_sb = 0, total_spl_fog_p_lm = 0, total_spl_fog_p_lm_lb = 0, total_spl_fog_p_lm_sb = 0,
				 total_spl_whse_rec = 0, total_spl_whse_rel = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
		where t.Rn = 1
	
	update dbo.ttspl set release_no = '''', release_date = null, qc_release_no = '''', qc_release_date = null, qc_fwhse_recvd_date = null, fwhse_pntg_recvd_date = null, pntg_blasting_date = null, pntg_primer_date = null, pntg_intermediate_date = null, pntg_painted_date = null, pntg_release_no = '''', pntg_release_date = null;
	
	declare @spool_no1 varchar(max)
	declare @pip_iso_no varchar(max)
	declare @spool_no varchar(max)
	declare @qc_release_date date
	declare @qc_release_no varchar(max)
	declare @weld_total_dia decimal
	declare @sys_no varchar(max)
	declare @linear_total_lm decimal
	declare @lb_sb varchar(max)
	declare @piping_class varchar(max)
	declare @PROGRESS_RECID bigint
	declare crs cursor read_only
		for select spool_no1, pip_iso_no, spool_no, qc_release_date, qc_release_no, weld_total_dia, sys_no, linear_total_lm, lb_sb, piping_class, PROGRESS_RECID from dbo.ttspl
				
	open crs
	fetch next from crs into @spool_no1, @pip_iso_no, @spool_no, @qc_release_date, @qc_release_no, @weld_total_dia, @sys_no, @linear_total_lm, @lb_sb, @piping_class, @PROGRESS_RECID
	while @@FETCH_STATUS = 0
	begin
		
		if (@spool_no1 != '''')
		begin			
			declare @event int = 0
			declare @fspl_release_no varchar(max)
			declare @fspl_release_date date
			declare @fspl_qc_release_date date
			declare @fspl_qc_release_no varchar(max)
			declare @fspl_qc_fwhse_recvd_date date
			declare @fspl_fwhse_pntg_recvd_date date
			declare @fspl_pntg_blasting_date date
			declare @fspl_pntg_primer_date date
			declare @fspl_pntg_release_no date
			declare @fspl_pntg_release_date date
			declare @fspl_pntg_intermediate_date date
			declare @fspl_pntg_painted_date date
			update t set engr = 1, @event = t.engr, @fspl_qc_release_date = t.qc_release_date, @fspl_qc_release_no = t.qc_release_no, @fspl_qc_fwhse_recvd_date = t.qc_fwhse_recvd_date, @fspl_fwhse_pntg_recvd_date = t.fwhse_pntg_recvd_date, @fspl_pntg_blasting_date = t.pntg_blasting_date, @fspl_pntg_primer_date = t.pntg_primer_date, @fspl_pntg_release_no = t.pntg_release_no, @fspl_pntg_release_date = t.pntg_release_date, @fspl_pntg_intermediate_date = t.pntg_intermediate_date, @fspl_pntg_painted_date = t.pntg_painted_date
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.pip_fspl_data tp where tp.pip_iso_no = @pip_iso_no and tp.spool_no = (case when (CHARINDEX(''-'',@spool_no,1) > 0) then (case when (substring(dbo.entry_fn(dbo.num_entries_fn(@spool_no,''-''),@spool_no,''-''),1,1) = ''0'') then (substring(dbo.entry_fn(dbo.num_entries_fn(@spool_no,''-''),@spool_no,''-''),2,LEN(@spool_no))) else (dbo.entry_fn(dbo.num_entries_fn(@spool_no,''-''),@spool_no,''-'')) end) else @spool_no end)) t
				where t.Rn = 1
				
			if (@event = 1)
			begin
				update t set release_no = @fspl_release_no, release_date = @fspl_release_date, qc_release_no = @fspl_qc_release_no, qc_release_date = @fspl_qc_release_date, qc_fwhse_recvd_date = @fspl_qc_fwhse_recvd_date, fwhse_pntg_recvd_date = @fspl_fwhse_pntg_recvd_date, pntg_blasting_date = @fspl_pntg_blasting_date, pntg_primer_date = @fspl_pntg_primer_date, pntg_release_no = @fspl_pntg_release_no, pntg_release_date = @fspl_pntg_release_date
					from dbo.ttspl t where t.PROGRESS_RECID = @PROGRESS_RECID
					
				if (@qc_release_date is not null and CHARINDEX(''S'',@qc_release_no,1) = 1)
				begin
					update t set total_spl_qc_s = (t.total_spl_qc_s + 1), total_spl_qc_s_dia = (t.total_spl_qc_s_dia + @weld_total_dia),
								 total_spl_qc_s_dia_lb = (t.total_spl_qc_s_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)),
								 total_spl_qc_s_dia_sb = (t.total_spl_qc_s_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)),
								 total_spl_qc_s_lm = (t.total_spl_qc_s_lm + @linear_total_lm),
								 total_spl_qc_s_lm_lb = (t.total_spl_qc_s_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
								 total_spl_qc_s_lm_sb = (t.total_spl_qc_s_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys tp where tp.sys_no = @sys_no) t
						where t.Rn = 1
						
					update t set total_spl_qc_s = (t.total_spl_qc_s + 1), total_spl_qc_s_dia = (t.total_spl_qc_s_dia + @weld_total_dia),
								 total_spl_qc_s_dia_lb = (t.total_spl_qc_s_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)),
								 total_spl_qc_s_dia_sb = (t.total_spl_qc_s_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)),
								 total_spl_qc_s_lm = (t.total_spl_qc_s_lm + @linear_total_lm),
								 total_spl_qc_s_lm_lb = (t.total_spl_qc_s_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
								 total_spl_qc_s_lm_sb = (t.total_spl_qc_s_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ag tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
						where t.Rn = 1
						
					update t set total_spl_qc_s = (t.total_spl_qc_s + 1), total_spl_qc_s_dia = (t.total_spl_qc_s_dia + @weld_total_dia),
								 total_spl_qc_s_dia_lb = (t.total_spl_qc_s_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)),
								 total_spl_qc_s_dia_sb = (t.total_spl_qc_s_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)),
								 total_spl_qc_s_lm = (t.total_spl_qc_s_lm + @linear_total_lm),
								 total_spl_qc_s_lm_lb = (t.total_spl_qc_s_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
								 total_spl_qc_s_lm_sb = (t.total_spl_qc_s_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ug tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
						where t.Rn = 1
						
					update t set total_spl_qc_s = (t.total_spl_qc_s + 1), total_spl_qc_s_dia = (total_spl_qc_s_dia + @weld_total_dia), total_spl_qc_s_dia_lb = (total_spl_qc_s_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), 
						total_spl_qc_s_dia_sb = (t.total_spl_qc_s_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)), total_spl_qc_s_lm = (total_spl_qc_s_lm + @linear_total_lm), total_spl_qc_s_lm_lb = (total_spl_qc_s_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
						total_spl_qc_s_lm_sb = (t.total_spl_qc_s_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
						
					update t set total_spl_qc_s = (t.total_spl_qc_s + 1), total_spl_qc_s_dia = (total_spl_qc_s_dia + @weld_total_dia), total_spl_qc_s_dia_lb = (total_spl_qc_s_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), 
						total_spl_qc_s_dia_sb = (t.total_spl_qc_s_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)), total_spl_qc_s_lm = (total_spl_qc_s_lm + @linear_total_lm), total_spl_qc_s_lm_lb = (total_spl_qc_s_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
						total_spl_qc_s_lm_sb = (t.total_spl_qc_s_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp where tp.piping_class = @piping_class) t
						where t.Rn = 1
						
					update t set total_spl_qc_s = (t.total_spl_qc_s + 1), total_spl_qc_s_dia = (total_spl_qc_s_dia + @weld_total_dia), total_spl_qc_s_dia_lb = (total_spl_qc_s_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), 
						total_spl_qc_s_dia_sb = (t.total_spl_qc_s_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)), total_spl_qc_s_lm = (total_spl_qc_s_lm + @linear_total_lm), total_spl_qc_s_lm_lb = (total_spl_qc_s_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
						total_spl_qc_s_lm_sb = (t.total_spl_qc_s_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp where tp.piping_class = @piping_class) t
						where t.Rn = 1
						
					if (@fspl_qc_release_date is not null and charindex(''P'',@fspl_qc_release_no,1) = 1)
					begin
						-- proc_internal_tbl1
						update t set total_spl_qc_p = (t.total_spl_qc_p + 1), total_spl_qc_p_dia = (total_spl_qc_p_dia + @weld_total_dia), total_spl_qc_p_dia_lb = (total_spl_qc_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), 
							total_spl_qc_p_dia_sb = (t.total_spl_qc_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)), total_spl_qc_p_lm = (total_spl_qc_p_lm + @linear_total_lm), total_spl_qc_p_lm_lb = (total_spl_qc_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_lm_sb = (t.total_spl_qc_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_b = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b + 1) else t.total_spl_qc_p_b end), 
							total_spl_qc_p_b_dia = (case when (@fspl_pntg_blasting_date is not null) then (total_spl_qc_p_b_dia + @weld_total_dia) else t.total_spl_qc_p_b_dia end), 
							total_spl_qc_p_b_dia_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_lb end), 
							total_spl_qc_p_b_dia_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_sb end),
							total_spl_qc_p_b_lm = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm + @linear_total_lm) else t.total_spl_qc_p_b_lm end), 
							total_spl_qc_p_b_lm_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_lb end),
							total_spl_qc_p_b_lm_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_sb end),
							total_spl_qc_p_p = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p + 1) else t.total_spl_qc_p_p end), 
							total_spl_qc_p_p_dia = (case when (@fspl_pntg_primer_date is not null) then (total_spl_qc_p_p_dia + @weld_total_dia) else t.total_spl_qc_p_p_dia end), 
							total_spl_qc_p_p_dia_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_lb end), 
							total_spl_qc_p_p_dia_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_sb end),
							total_spl_qc_p_p_lm = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm + @linear_total_lm) else t.total_spl_qc_p_p_lm end), 
							total_spl_qc_p_p_lm_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_lb end),
							total_spl_qc_p_p_lm_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_sb end),
							total_spl_qc_p_i = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i + 1) else t.total_spl_qc_p_i end), 
							total_spl_qc_p_i_dia = (case when (@fspl_pntg_intermediate_date is not null) then (total_spl_qc_p_i_dia + @weld_total_dia) else t.total_spl_qc_p_i_dia end), 
							total_spl_qc_p_i_dia_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_lb end), 
							total_spl_qc_p_i_dia_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_sb end),
							total_spl_qc_p_i_lm = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm + @linear_total_lm) else t.total_spl_qc_p_i_lm end), 
							total_spl_qc_p_i_lm_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_lb end),
							total_spl_qc_p_i_lm_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_sb end),
							total_spl_qc_p_f = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f + 1) else t.total_spl_qc_p_f end), 
							total_spl_qc_p_f_dia = (case when (@fspl_pntg_painted_date is not null) then (total_spl_qc_p_f_dia + @weld_total_dia) else t.total_spl_qc_p_f_dia end), 
							total_spl_qc_p_f_dia_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_lb end), 
							total_spl_qc_p_f_dia_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_sb end),
							total_spl_qc_p_f_lm = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm + @linear_total_lm) else t.total_spl_qc_p_f_lm end), 
							total_spl_qc_p_f_lm_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_lb end),
							total_spl_qc_p_f_lm_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_sb end),
							total_spl_pntg = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg + 1) else t.total_spl_pntg end), 
							total_spl_pntg_dia = (case when (@fspl_pntg_release_date is not null) then (total_spl_pntg_dia + @weld_total_dia) else t.total_spl_pntg_dia end), 
							total_spl_pntg_dia_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_lb end), 
							total_spl_pntg_dia_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_sb end),
							total_spl_pntg_lm = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm + @linear_total_lm) else t.total_spl_pntg_lm end), 
							total_spl_pntg_lm_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_lb end),
							total_spl_pntg_lm_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_sb end)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys tp where tp.sys_no = @sys_no) t
							where t.Rn = 1
						update t set total_spl_qc_p = (t.total_spl_qc_p + 1), total_spl_qc_p_dia = (total_spl_qc_p_dia + @weld_total_dia), total_spl_qc_p_dia_lb = (total_spl_qc_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), 
							total_spl_qc_p_dia_sb = (t.total_spl_qc_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)), total_spl_qc_p_lm = (total_spl_qc_p_lm + @linear_total_lm), total_spl_qc_p_lm_lb = (total_spl_qc_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_lm_sb = (t.total_spl_qc_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_b = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b + 1) else t.total_spl_qc_p_b end), 
							total_spl_qc_p_b_dia = (case when (@fspl_pntg_blasting_date is not null) then (total_spl_qc_p_b_dia + @weld_total_dia) else t.total_spl_qc_p_b_dia end), 
							total_spl_qc_p_b_dia_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_lb end), 
							total_spl_qc_p_b_dia_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_sb end),
							total_spl_qc_p_b_lm = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm + @linear_total_lm) else t.total_spl_qc_p_b_lm end), 
							total_spl_qc_p_b_lm_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_lb end),
							total_spl_qc_p_b_lm_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_sb end),
							total_spl_qc_p_p = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p + 1) else t.total_spl_qc_p_p end), 
							total_spl_qc_p_p_dia = (case when (@fspl_pntg_primer_date is not null) then (total_spl_qc_p_p_dia + @weld_total_dia) else t.total_spl_qc_p_p_dia end), 
							total_spl_qc_p_p_dia_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_lb end), 
							total_spl_qc_p_p_dia_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_sb end),
							total_spl_qc_p_p_lm = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm + @linear_total_lm) else t.total_spl_qc_p_p_lm end), 
							total_spl_qc_p_p_lm_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_lb end),
							total_spl_qc_p_p_lm_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_sb end),
							total_spl_qc_p_i = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i + 1) else t.total_spl_qc_p_i end), 
							total_spl_qc_p_i_dia = (case when (@fspl_pntg_intermediate_date is not null) then (total_spl_qc_p_i_dia + @weld_total_dia) else t.total_spl_qc_p_i_dia end), 
							total_spl_qc_p_i_dia_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_lb end), 
							total_spl_qc_p_i_dia_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_sb end),
							total_spl_qc_p_i_lm = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm + @linear_total_lm) else t.total_spl_qc_p_i_lm end), 
							total_spl_qc_p_i_lm_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_lb end),
							total_spl_qc_p_i_lm_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_sb end),
							total_spl_qc_p_f = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f + 1) else t.total_spl_qc_p_f end), 
							total_spl_qc_p_f_dia = (case when (@fspl_pntg_painted_date is not null) then (total_spl_qc_p_f_dia + @weld_total_dia) else t.total_spl_qc_p_f_dia end), 
							total_spl_qc_p_f_dia_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_lb end), 
							total_spl_qc_p_f_dia_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_sb end),
							total_spl_qc_p_f_lm = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm + @linear_total_lm) else t.total_spl_qc_p_f_lm end), 
							total_spl_qc_p_f_lm_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_lb end),
							total_spl_qc_p_f_lm_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_sb end),
							total_spl_pntg = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg + 1) else t.total_spl_pntg end), 
							total_spl_pntg_dia = (case when (@fspl_pntg_release_date is not null) then (total_spl_pntg_dia + @weld_total_dia) else t.total_spl_pntg_dia end), 
							total_spl_pntg_dia_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_lb end), 
							total_spl_pntg_dia_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_sb end),
							total_spl_pntg_lm = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm + @linear_total_lm) else t.total_spl_pntg_lm end), 
							total_spl_pntg_lm_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_lb end),
							total_spl_pntg_lm_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_sb end)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ag tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
							where t.Rn = 1
						update t set total_spl_qc_p = (t.total_spl_qc_p + 1), total_spl_qc_p_dia = (total_spl_qc_p_dia + @weld_total_dia), total_spl_qc_p_dia_lb = (total_spl_qc_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), 
							total_spl_qc_p_dia_sb = (t.total_spl_qc_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)), total_spl_qc_p_lm = (total_spl_qc_p_lm + @linear_total_lm), total_spl_qc_p_lm_lb = (total_spl_qc_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_lm_sb = (t.total_spl_qc_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_b = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b + 1) else t.total_spl_qc_p_b end), 
							total_spl_qc_p_b_dia = (case when (@fspl_pntg_blasting_date is not null) then (total_spl_qc_p_b_dia + @weld_total_dia) else t.total_spl_qc_p_b_dia end), 
							total_spl_qc_p_b_dia_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_lb end), 
							total_spl_qc_p_b_dia_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_sb end),
							total_spl_qc_p_b_lm = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm + @linear_total_lm) else t.total_spl_qc_p_b_lm end), 
							total_spl_qc_p_b_lm_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_lb end),
							total_spl_qc_p_b_lm_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_sb end),
							total_spl_qc_p_p = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p + 1) else t.total_spl_qc_p_p end), 
							total_spl_qc_p_p_dia = (case when (@fspl_pntg_primer_date is not null) then (total_spl_qc_p_p_dia + @weld_total_dia) else t.total_spl_qc_p_p_dia end), 
							total_spl_qc_p_p_dia_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_lb end), 
							total_spl_qc_p_p_dia_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_sb end),
							total_spl_qc_p_p_lm = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm + @linear_total_lm) else t.total_spl_qc_p_p_lm end), 
							total_spl_qc_p_p_lm_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_lb end),
							total_spl_qc_p_p_lm_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_sb end),
							total_spl_qc_p_i = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i + 1) else t.total_spl_qc_p_i end), 
							total_spl_qc_p_i_dia = (case when (@fspl_pntg_intermediate_date is not null) then (total_spl_qc_p_i_dia + @weld_total_dia) else t.total_spl_qc_p_i_dia end), 
							total_spl_qc_p_i_dia_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_lb end), 
							total_spl_qc_p_i_dia_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_sb end),
							total_spl_qc_p_i_lm = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm + @linear_total_lm) else t.total_spl_qc_p_i_lm end), 
							total_spl_qc_p_i_lm_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_lb end),
							total_spl_qc_p_i_lm_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_sb end),
							total_spl_qc_p_f = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f + 1) else t.total_spl_qc_p_f end), 
							total_spl_qc_p_f_dia = (case when (@fspl_pntg_painted_date is not null) then (total_spl_qc_p_f_dia + @weld_total_dia) else t.total_spl_qc_p_f_dia end), 
							total_spl_qc_p_f_dia_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_lb end), 
							total_spl_qc_p_f_dia_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_sb end),
							total_spl_qc_p_f_lm = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm + @linear_total_lm) else t.total_spl_qc_p_f_lm end), 
							total_spl_qc_p_f_lm_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_lb end),
							total_spl_qc_p_f_lm_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_sb end),
							total_spl_pntg = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg + 1) else t.total_spl_pntg end), 
							total_spl_pntg_dia = (case when (@fspl_pntg_release_date is not null) then (total_spl_pntg_dia + @weld_total_dia) else t.total_spl_pntg_dia end), 
							total_spl_pntg_dia_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_lb end), 
							total_spl_pntg_dia_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_sb end),
							total_spl_pntg_lm = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm + @linear_total_lm) else t.total_spl_pntg_lm end), 
							total_spl_pntg_lm_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_lb end),
							total_spl_pntg_lm_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_sb end)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttsys_ug tp where tp.sys_no = @sys_no and tp.piping_class = @piping_class) t
							where t.Rn = 1
						-- proc_internal_tbl1-1
						update t set total_spl_qc_p = (t.total_spl_qc_p + 1), total_spl_qc_p_dia = (total_spl_qc_p_dia + @weld_total_dia), total_spl_qc_p_dia_lb = (total_spl_qc_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), 
							total_spl_qc_p_dia_sb = (t.total_spl_qc_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)), total_spl_qc_p_lm = (total_spl_qc_p_lm + @linear_total_lm), total_spl_qc_p_lm_lb = (total_spl_qc_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_lm_sb = (t.total_spl_qc_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_b = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b + 1) else t.total_spl_qc_p_b end), 
							total_spl_qc_p_b_dia = (case when (@fspl_pntg_blasting_date is not null) then (total_spl_qc_p_b_dia + @weld_total_dia) else t.total_spl_qc_p_b_dia end), 
							total_spl_qc_p_b_dia_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_lb end), 
							total_spl_qc_p_b_dia_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_sb end),
							total_spl_qc_p_b_lm = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm + @linear_total_lm) else t.total_spl_qc_p_b_lm end), 
							total_spl_qc_p_b_lm_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_lb end),
							total_spl_qc_p_b_lm_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_sb end),
							total_spl_qc_p_p = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p + 1) else t.total_spl_qc_p_p end), 
							total_spl_qc_p_p_dia = (case when (@fspl_pntg_primer_date is not null) then (total_spl_qc_p_p_dia + @weld_total_dia) else t.total_spl_qc_p_p_dia end), 
							total_spl_qc_p_p_dia_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_lb end), 
							total_spl_qc_p_p_dia_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_sb end),
							total_spl_qc_p_p_lm = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm + @linear_total_lm) else t.total_spl_qc_p_p_lm end), 
							total_spl_qc_p_p_lm_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_lb end),
							total_spl_qc_p_p_lm_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_sb end),
							total_spl_qc_p_i = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i + 1) else t.total_spl_qc_p_i end), 
							total_spl_qc_p_i_dia = (case when (@fspl_pntg_intermediate_date is not null) then (total_spl_qc_p_i_dia + @weld_total_dia) else t.total_spl_qc_p_i_dia end), 
							total_spl_qc_p_i_dia_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_lb end), 
							total_spl_qc_p_i_dia_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_sb end),
							total_spl_qc_p_i_lm = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm + @linear_total_lm) else t.total_spl_qc_p_i_lm end), 
							total_spl_qc_p_i_lm_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_lb end),
							total_spl_qc_p_i_lm_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_sb end),
							total_spl_qc_p_f = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f + 1) else t.total_spl_qc_p_f end), 
							total_spl_qc_p_f_dia = (case when (@fspl_pntg_painted_date is not null) then (total_spl_qc_p_f_dia + @weld_total_dia) else t.total_spl_qc_p_f_dia end), 
							total_spl_qc_p_f_dia_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_lb end), 
							total_spl_qc_p_f_dia_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_sb end),
							total_spl_qc_p_f_lm = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm + @linear_total_lm) else t.total_spl_qc_p_f_lm end), 
							total_spl_qc_p_f_lm_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_lb end),
							total_spl_qc_p_f_lm_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_sb end),
							total_spl_pntg = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg + 1) else t.total_spl_pntg end), 
							total_spl_pntg_dia = (case when (@fspl_pntg_release_date is not null) then (total_spl_pntg_dia + @weld_total_dia) else t.total_spl_pntg_dia end), 
							total_spl_pntg_dia_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_lb end), 
							total_spl_pntg_dia_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_sb end),
							total_spl_pntg_lm = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm + @linear_total_lm) else t.total_spl_pntg_lm end), 
							total_spl_pntg_lm_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_lb end),
							total_spl_pntg_lm_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_sb end)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
							where t.Rn = 1
						update t set total_spl_qc_p = (t.total_spl_qc_p + 1), total_spl_qc_p_dia = (total_spl_qc_p_dia + @weld_total_dia), total_spl_qc_p_dia_lb = (total_spl_qc_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), 
							total_spl_qc_p_dia_sb = (t.total_spl_qc_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)), total_spl_qc_p_lm = (total_spl_qc_p_lm + @linear_total_lm), total_spl_qc_p_lm_lb = (total_spl_qc_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_lm_sb = (t.total_spl_qc_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_b = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b + 1) else t.total_spl_qc_p_b end), 
							total_spl_qc_p_b_dia = (case when (@fspl_pntg_blasting_date is not null) then (total_spl_qc_p_b_dia + @weld_total_dia) else t.total_spl_qc_p_b_dia end), 
							total_spl_qc_p_b_dia_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_lb end), 
							total_spl_qc_p_b_dia_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_sb end),
							total_spl_qc_p_b_lm = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm + @linear_total_lm) else t.total_spl_qc_p_b_lm end), 
							total_spl_qc_p_b_lm_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_lb end),
							total_spl_qc_p_b_lm_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_sb end),
							total_spl_qc_p_p = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p + 1) else t.total_spl_qc_p_p end), 
							total_spl_qc_p_p_dia = (case when (@fspl_pntg_primer_date is not null) then (total_spl_qc_p_p_dia + @weld_total_dia) else t.total_spl_qc_p_p_dia end), 
							total_spl_qc_p_p_dia_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_lb end), 
							total_spl_qc_p_p_dia_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_sb end),
							total_spl_qc_p_p_lm = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm + @linear_total_lm) else t.total_spl_qc_p_p_lm end), 
							total_spl_qc_p_p_lm_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_lb end),
							total_spl_qc_p_p_lm_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_sb end),
							total_spl_qc_p_i = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i + 1) else t.total_spl_qc_p_i end), 
							total_spl_qc_p_i_dia = (case when (@fspl_pntg_intermediate_date is not null) then (total_spl_qc_p_i_dia + @weld_total_dia) else t.total_spl_qc_p_i_dia end), 
							total_spl_qc_p_i_dia_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_lb end), 
							total_spl_qc_p_i_dia_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_sb end),
							total_spl_qc_p_i_lm = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm + @linear_total_lm) else t.total_spl_qc_p_i_lm end), 
							total_spl_qc_p_i_lm_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_lb end),
							total_spl_qc_p_i_lm_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_sb end),
							total_spl_qc_p_f = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f + 1) else t.total_spl_qc_p_f end), 
							total_spl_qc_p_f_dia = (case when (@fspl_pntg_painted_date is not null) then (total_spl_qc_p_f_dia + @weld_total_dia) else t.total_spl_qc_p_f_dia end), 
							total_spl_qc_p_f_dia_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_lb end), 
							total_spl_qc_p_f_dia_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_sb end),
							total_spl_qc_p_f_lm = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm + @linear_total_lm) else t.total_spl_qc_p_f_lm end), 
							total_spl_qc_p_f_lm_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_lb end),
							total_spl_qc_p_f_lm_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_sb end),
							total_spl_pntg = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg + 1) else t.total_spl_pntg end), 
							total_spl_pntg_dia = (case when (@fspl_pntg_release_date is not null) then (total_spl_pntg_dia + @weld_total_dia) else t.total_spl_pntg_dia end), 
							total_spl_pntg_dia_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_lb end), 
							total_spl_pntg_dia_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_sb end),
							total_spl_pntg_lm = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm + @linear_total_lm) else t.total_spl_pntg_lm end), 
							total_spl_pntg_lm_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_lb end),
							total_spl_pntg_lm_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_sb end)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp where tp.piping_class = @piping_class) t
							where t.Rn = 1
						update t set total_spl_qc_p = (t.total_spl_qc_p + 1), total_spl_qc_p_dia = (total_spl_qc_p_dia + @weld_total_dia), total_spl_qc_p_dia_lb = (total_spl_qc_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)), 
							total_spl_qc_p_dia_sb = (t.total_spl_qc_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)), total_spl_qc_p_lm = (total_spl_qc_p_lm + @linear_total_lm), total_spl_qc_p_lm_lb = (total_spl_qc_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_lm_sb = (t.total_spl_qc_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)),
							total_spl_qc_p_b = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b + 1) else t.total_spl_qc_p_b end), 
							total_spl_qc_p_b_dia = (case when (@fspl_pntg_blasting_date is not null) then (total_spl_qc_p_b_dia + @weld_total_dia) else t.total_spl_qc_p_b_dia end), 
							total_spl_qc_p_b_dia_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_lb end), 
							total_spl_qc_p_b_dia_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_b_dia_sb end),
							total_spl_qc_p_b_lm = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm + @linear_total_lm) else t.total_spl_qc_p_b_lm end), 
							total_spl_qc_p_b_lm_lb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_lb end),
							total_spl_qc_p_b_lm_sb = (case when (@fspl_pntg_blasting_date is not null) then (t.total_spl_qc_p_b_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_b_lm_sb end),
							total_spl_qc_p_p = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p + 1) else t.total_spl_qc_p_p end), 
							total_spl_qc_p_p_dia = (case when (@fspl_pntg_primer_date is not null) then (total_spl_qc_p_p_dia + @weld_total_dia) else t.total_spl_qc_p_p_dia end), 
							total_spl_qc_p_p_dia_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_lb end), 
							total_spl_qc_p_p_dia_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_p_dia_sb end),
							total_spl_qc_p_p_lm = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm + @linear_total_lm) else t.total_spl_qc_p_p_lm end), 
							total_spl_qc_p_p_lm_lb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_lb end),
							total_spl_qc_p_p_lm_sb = (case when (@fspl_pntg_primer_date is not null) then (t.total_spl_qc_p_p_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_p_lm_sb end),
							total_spl_qc_p_i = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i + 1) else t.total_spl_qc_p_i end), 
							total_spl_qc_p_i_dia = (case when (@fspl_pntg_intermediate_date is not null) then (total_spl_qc_p_i_dia + @weld_total_dia) else t.total_spl_qc_p_i_dia end), 
							total_spl_qc_p_i_dia_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_lb end), 
							total_spl_qc_p_i_dia_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_i_dia_sb end),
							total_spl_qc_p_i_lm = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm + @linear_total_lm) else t.total_spl_qc_p_i_lm end), 
							total_spl_qc_p_i_lm_lb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_lb end),
							total_spl_qc_p_i_lm_sb = (case when (@fspl_pntg_intermediate_date is not null) then (t.total_spl_qc_p_i_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_i_lm_sb end),
							total_spl_qc_p_f = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f + 1) else t.total_spl_qc_p_f end), 
							total_spl_qc_p_f_dia = (case when (@fspl_pntg_painted_date is not null) then (total_spl_qc_p_f_dia + @weld_total_dia) else t.total_spl_qc_p_f_dia end), 
							total_spl_qc_p_f_dia_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_lb end), 
							total_spl_qc_p_f_dia_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_qc_p_f_dia_sb end),
							total_spl_qc_p_f_lm = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm + @linear_total_lm) else t.total_spl_qc_p_f_lm end), 
							total_spl_qc_p_f_lm_lb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_lb end),
							total_spl_qc_p_f_lm_sb = (case when (@fspl_pntg_painted_date is not null) then (t.total_spl_qc_p_f_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_qc_p_f_lm_sb end),
							total_spl_pntg = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg + 1) else t.total_spl_pntg end), 
							total_spl_pntg_dia = (case when (@fspl_pntg_release_date is not null) then (total_spl_pntg_dia + @weld_total_dia) else t.total_spl_pntg_dia end), 
							total_spl_pntg_dia_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_lb + (case when (@lb_sb = ''LB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_lb end), 
							total_spl_pntg_dia_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_dia_sb + (case when (@lb_sb = ''SB'') then @weld_total_dia else 0 end)) else t.total_spl_pntg_dia_sb end),
							total_spl_pntg_lm = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm + @linear_total_lm) else t.total_spl_pntg_lm end), 
							total_spl_pntg_lm_lb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_lb + (case when (@lb_sb = ''LB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_lb end),
							total_spl_pntg_lm_sb = (case when (@fspl_pntg_release_date is not null) then (t.total_spl_pntg_lm_sb + (case when (@lb_sb = ''SB'') then @linear_total_lm else 0 end)) else t.total_spl_pntg_lm_sb end)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp where tp.piping_class = @piping_class) t
							where t.Rn = 1
					end
				end
			end
		end
		
		fetch next from crs into @spool_no1, @pip_iso_no, @spool_no, @qc_release_date, @qc_release_no, @weld_total_dia, @sys_no, @linear_total_lm, @lb_sb, @piping_class, @PROGRESS_RECID
	end
	close crs
	deallocate crs
		
	--proc_internal_tbl2		
	
	update dbo.tttpspl set release_no = '''', release_date = null, qc_release_no = '''', qc_release_date = null, qc_fwhse_recvd_date = null, fwhse_pntg_recvd_date = null, pntg_blasting_date = null, pntg_primer_date = null, pntg_intermediate_date = null, pntg_painted_date = null, pntg_release_no = null, pntg_release_date = null

	select @spool_no1 = '''', @pip_iso_no = '''', @spool_no = '''', @PROGRESS_RECID = 0;
	declare crs_tt cursor read_only
		for select spool_no1, pip_iso_no, spool_no, PROGRESS_RECID from dbo.tttpspl
				
	open crs_tt
	fetch next from crs_tt into @spool_no1, @pip_iso_no, @spool_no, @PROGRESS_RECID
	while @@FETCH_STATUS = 0
	begin
		if (@spool_no1 != '''')
		begin
			update t set @fspl_release_no = t.release_no, @fspl_release_date = t.release_date, @fspl_qc_release_date = t.qc_release_date, @fspl_qc_release_no = t.qc_release_no, @fspl_qc_fwhse_recvd_date = t.qc_fwhse_recvd_date, @fspl_fwhse_pntg_recvd_date = t.fwhse_pntg_recvd_date, @fspl_pntg_blasting_date = t.pntg_blasting_date, @fspl_pntg_primer_date = t.pntg_primer_date, @fspl_pntg_release_no = t.pntg_release_no, @fspl_pntg_release_date = t.pntg_release_date, @fspl_pntg_intermediate_date = t.pntg_intermediate_date, @fspl_pntg_painted_date = t.pntg_painted_date
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.pip_fspl_data tp where tp.pip_iso_no = @pip_iso_no and tp.spool_no = (case when (CHARINDEX(''-'',@spool_no,1) > 0) then (case when (substring(dbo.entry_fn(dbo.num_entries_fn(@spool_no,''-''),@spool_no,''-''),1,1) = ''0'') then (substring(dbo.entry_fn(dbo.num_entries_fn(@spool_no,''-''),@spool_no,''-''),2,LEN(@spool_no))) else (dbo.entry_fn(dbo.num_entries_fn(@spool_no,''-''),@spool_no,''-'')) end) else @spool_no end)) t
				where t.Rn = 1
				
			update t set release_no = @fspl_release_no, release_date = @fspl_release_date, qc_release_no = @fspl_qc_release_no, qc_release_date = @fspl_qc_release_date, qc_fwhse_recvd_date = @fspl_qc_fwhse_recvd_date, fwhse_pntg_recvd_date = @fspl_fwhse_pntg_recvd_date, pntg_blasting_date = @fspl_pntg_blasting_date, pntg_primer_date = @fspl_pntg_primer_date, pntg_release_no = @fspl_pntg_release_no, pntg_release_date = @fspl_pntg_release_date
				from dbo.tttpspl t where t.PROGRESS_RECID = @PROGRESS_RECID
		end
		
		fetch next from crs_tt into @spool_no1, @pip_iso_no, @spool_no, @PROGRESS_RECID
	end
	close crs_tt
	deallocate crs_tt
	
	update t set maintenance = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
		where t.Rn = 1

    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[isoMQ2_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[isoMQ2_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[isoMQ2_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	declare @action TABLE(change VARCHAR(20))
	declare @ttTPTT table(tp_no VARCHAR(MAX), test_type VARCHAR(MAX))
	SET NOCOUNT ON;

	begin transaction;
	
	-- proc_internal_clr
	delete from dbo.ttsubsys;
	delete from dbo.ttsubsys_ag;
	delete from dbo.ttsubsys_ug;
	delete from dbo.tttp;
	delete from dbo.tttpiso;
	delete from dbo.tttpspl;
	update dbo.ttconstn set dbo.ttconstn.testpack_prep = 0, dbo.ttconstn.tp_type_h = 0, dbo.ttconstn.tp_type_s = 0, dbo.ttconstn.tp_type_v = 0, dbo.ttconstn.tp_type_c = 0;
	update dbo.tttestpack set dbo.tttestpack.spoolgen_prep = 0, dbo.tttestpack.linear_shop = 0, dbo.tttestpack.linear_field = 0, dbo.tttestpack.linear_total_lm = 0, dbo.tttestpack.spool_qty = 0, dbo.tttestpack.spool_qty_lb = 0, dbo.tttestpack.spool_qty_sb = 0;

	declare @i as int
	declare @pip_iso_no as varchar(max)	
	declare @tp_no as varchar(max)
	declare @tp_type_of_test as varchar(max)
	declare @piping_class as varchar(max)
	declare @area_desc as varchar(max)
	declare @field_desc as varchar(max)
	declare @priority_timing as varchar(max)
	declare @priority_no as varchar(max)
	declare @unit_area as varchar(max)
	declare @constn_area as varchar(max)
	declare @sheet_no as varchar(max)
	declare @rev_no as varchar(max)
	declare @insul_lm_untraced as decimal(19, 4)
	declare @insul_lm_traced as decimal(19, 4)
	declare @iso_lb_sb as varchar(max)
	declare @pipmto_lb_sb as varchar(max)
	declare @spool_no as varchar(max)	
	declare @client_dwg_no as varchar(max)
	declare @line_no as varchar(max)
	declare @line_class as varchar(max)
	declare @material as varchar(max)
	declare @item_code as varchar(max)
	declare @spool_category as varchar(max)
	declare @size as varchar(max)
	declare @group_size as varchar(max)
	declare @qty as decimal(19, 4)
	declare @item_no as varchar(max)
	declare @fitting_length as decimal(19, 4)
	declare @total_length as decimal(19, 4)
	declare @bolt_length as decimal(19, 4)
	declare @group_1 as varchar(max)
	declare @group_2 as varchar(max)
	declare @mat_description as varchar(max)
	declare @painting_specs as varchar(max)			
	declare @insul_type as varchar(max)
	declare @insul_thk as varchar(max)
	declare @insul_pipe_size as varchar(max)
	declare @tp_f_s as varchar(max)
	declare @total_sheets as varchar(max)			
	declare @painting_primer_s as decimal(19, 4)
	declare @painting_top_coat_s as decimal(19, 4)
	declare @file_origin as varchar(max)
	declare @spool_no1 as varchar(max)
	declare @pip_iso_no1 as varchar(max)
	declare @lb_sb as varchar(max)
	declare @tp_priority_no as varchar(max)
	declare @tp_priority_timing as varchar(max)
	declare crs cursor read_only
		for select tp_no, tp_type_of_test, piping_class, area_desc, field_desc, priority_timing, priority_no, unit_area,
			constn_area, pip_iso_no, sheet_no, rev_no, insul_lm_untraced, insul_lm_traced, iso_lb_sb, lb_sb, spool_no,
			client_dwg_no, line_no, line_class, material, item_code, spool_category, size, group_size, qty, item_no, 
			fitting_length, total_length, bolt_length, group_1, group_2, mat_description, painting_specs,
			insul_type, insul_thk, insul_pipe_size, tp_f_s, total_sheets, painting_primer_s, painting_top_coat_s,
			file_origin, spool_no1, tp_priority_no, tp_priority_timing,
			(case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) from dbo.pip_mto_data
				
	open crs
	fetch next from crs into @tp_no, @tp_type_of_test, @piping_class, @area_desc, @field_desc, @priority_timing, @priority_no, @unit_area, @constn_area, 
		@pip_iso_no, @sheet_no, @rev_no, @insul_lm_untraced, @insul_lm_traced, @iso_lb_sb, @pipmto_lb_sb, @spool_no, @client_dwg_no, @line_no, @line_class,
		@material, @item_code, @spool_category, @size, @group_size, @qty, @item_no, @fitting_length, @total_length, @bolt_length, @group_1, @group_2, 
		@mat_description, @painting_specs, @insul_type, @insul_thk, @insul_pipe_size, @tp_f_s, @total_sheets, @painting_primer_s, @painting_top_coat_s,
		@file_origin, @spool_no1, @tp_priority_no, @tp_priority_timing, @pip_iso_no1
	while @@FETCH_STATUS = 0
	begin
		if (@tp_no != '''' and (charindex(''H'',@tp_type_of_test,1) = 1 or CHARINDEX(''S'',@tp_type_of_test,1) = 1 or
							  charindex(''V'',@tp_type_of_test,1) = 1 or CHARINDEX(''C'',@tp_type_of_test,1) = 1))
		begin
			declare @numEntries as int
			set @numEntries = qms_pip.dbo.num_entries_fn(@tp_no,''/'')
			if (@numEntries > 0)
			begin
				-- proc_internal_tbl2-1
				set @i = 1;
				while @i < @numEntries
				begin
					delete from @action;
					merge dbo.tttp as target
					using (select @piping_class, ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))), @tp_type_of_test, @priority_no, @priority_timing, @unit_area, @total_length, @spool_no) as src 
						  (piping_class, tp_no, tp_type_of_test, priority_no, priority_timing, unit_area, total_length, spool_no)
					on (target.piping_class = src.piping_class and
						target.tp_no = src.tp_no)
					when matched then
						update set linear_shop = (case when (src.spool_no != ''ERECTION'' and src.spool_no != '''') then (target.linear_shop + src.total_length) else target.linear_shop end),
								   linear_total_lm = (target.linear_total_lm + src.total_length)
					when not matched then
						insert (piping_class, tp_no, tp_type_of_test, priority_no, priority_timing, constn_unit, linear_total_lm, linear_shop, loguser, logdate, logtime, logupdate)
						values (src.piping_class, src.tp_no, src.tp_type_of_test, src.priority_no, src.priority_timing, src.unit_area, src.total_length, (case when (src.spool_no != ''ERECTION'' and src.spool_no != '''') then src.total_length else 0 end), user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
					output $action into @action;
					
					if ((select change from @action) = ''INSERT'')
					begin
						merge @tttptt as target
						using (select ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))), @tp_type_of_test) as src 
							  (tp_no, tp_type_of_test)
						on (target.tp_no = src.tp_no and
							target.test_type = src.tp_type_of_test)
						when not matched then
							insert (tp_no, test_type)
							values (src.tp_no, src.tp_type_of_test);
							
						update t set total_tp = (t.total_tp + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm) t
						where t.Rn = 1
						
						if (@piping_class = ''A/G'')
						begin
							update t set total_tp = (t.total_tp + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag) t
							where t.Rn = 1
							
							delete from @action;
							merge dbo.ttsubsys_ag as target
							using (select @unit_area, substring(ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))),1, 7)) as src
								(unit_area, tp_no)
							on (target.sys_no = src.unit_area and
								target.subsys_no = src.tp_no and
								target.piping_class = ''A/G'')
							when not matched then
								insert (sys_no, subsys_no, piping_class, datasource, loguser, logdate, logtime, logupdate)
								values (src.unit_area, src.tp_no, ''A/G'', ''pip_mto_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
							output $action into @action;
							
							if ((select change from @action) = ''INSERT'')
							begin
								update t set total_subsys = (t.total_subsys + 1)
								from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag) t
								where t.Rn = 1								
							end
						end
						if (@piping_class = ''U/G'')
						begin
							update t set total_tp = (t.total_tp + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug) t
							where t.Rn = 1						
							
							delete from @action;
							merge dbo.ttsubsys_ug as target
							using (select @unit_area, substring(ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))),1, 7)) as src
								(unit_area, tp_no)
							on (target.sys_no = src.unit_area and
								target.subsys_no = src.tp_no and
								target.piping_class = ''U/G'')
							when not matched then
								insert (sys_no, subsys_no, piping_class, datasource, loguser, logdate, logtime, logupdate)
								values (src.unit_area, src.tp_no, ''U/G'', ''pip_mto_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
							output $action into @action;
							
							if ((select change from @action) = ''INSERT'')
							begin
								update t set total_subsys = (t.total_subsys + 1)
								from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug) t
								where t.Rn = 1								
							end
						end
							
						merge dbo.ttConstn as target
						using (select @piping_class, @priority_no, @priority_timing, @constn_area, @unit_area, @tp_type_of_test) as src
							  (piping_class, priority_no, priority_timing, constn_area, unit_area, tp_type_of_test)
						on (target.piping_class = src.piping_class and 
							target.priority_no = src.priority_no and 
							target.priority_timing = src.priority_timing and 
							target.constn_unit = src.constn_area and 
							target.unit_area = src.unit_area)
						when matched then
							update set testpack_prep = (testpack_prep + 1),
									   tp_type_h = (case when (charindex(''H'',src.tp_type_of_test,1) = 1) then (tp_type_h + 1) else (tp_type_h) end),
									   tp_type_s = (case when (charindex(''S'',src.tp_type_of_test,1) = 1) then (tp_type_s + 1) else (tp_type_s) end),
									   tp_type_v = (case when (charindex(''V'',src.tp_type_of_test,1) = 1) then (tp_type_v + 1) else (tp_type_v) end),
									   tp_type_c = (case when (charindex(''C'',src.tp_type_of_test,1) = 1) then (tp_type_c + 1) else (tp_type_c) end);							
								
						delete from @action;	   
						merge dbo.ttsubsys as target
						using (select @unit_area, substring(ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))),1, 7)) as src
							(unit_area, tp_no)
						on (target.sys_no = src.unit_area and
							target.subsys_no = src.tp_no)
						when not matched then
							insert (sys_no, subsys_no, datasource, loguser, logdate, logtime, logupdate)
							values(src.unit_area, src.tp_no, ''pip_mto_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
						output $action into @action;
					end
					else 
					begin
						merge @tttptt as target
						using (select ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))), @tp_type_of_test) as src
							(tp_no, tp_type_of_test)
						on (target.tp_no = src.tp_no and
							target.test_type = src.tp_type_of_test)
						when not matched then
							insert (tp_no, test_type)
							values (src.tp_no, src.tp_type_of_test);
						
						update t4 set tp_type_of_test = (case when (t4.tp_type_of_test = '''') then (t4.tp_type_of_test + ''/'' + t3.test_type) else '''' end)
							from dbo.tttp t4 inner join (
								select t2.*,t.test_type from @ttTPTT t inner join (
									select top 1 * from dbo.tttp order by PROGRESS_RECID desc
								) t2
								on t.tp_no = t2.tp_no
							) t3 on t4.PROGRESS_RECID = t3.PROGRESS_RECID
					end
					
					merge dbo.tttpiso as target
					using (select @piping_class, @constn_area, 
						(case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end),
						@sheet_no, @rev_no, ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))), @priority_no,
						@priority_timing, @constn_area, @unit_area, (@insul_lm_untraced + @insul_lm_traced),
						@iso_lb_sb, @tp_type_of_test, @total_length, @iso_lb_sb) as src
						(piping_class, constn_area, pip_iso_no, sheet_no, rev_no, tp_no, priority_no, priority_timing, constn_unit, unit_area, insul_lm, lb_sb, tp_type_of_test, total_length, iso_lb_sb)
					on (target.piping_class = src.piping_class and
						target.constn_area = src.constn_area and
						target.pip_iso_no = src.pip_iso_no and
						target.sheet_no = src.sheet_no and
						target.rev_no = src.rev_no and
						target.tp_no = src.tp_no)
					when matched then
						update set insul_lm = (target.insul_lm + (src.insul_lm)),
								   lb_sb = (case when (target.lb_sb = ''SB'' and src.iso_lb_sb = ''LB'') then src.iso_lb_sb else target.lb_sb end),
								   linear_shop = (case when (@spool_no != ''ERECTION'' and @spool_no != '''') then (target.linear_shop + src.total_length) else target.linear_shop end),
								   linear_total_lm = (target.linear_total_lm + src.total_length)
					when not matched then
						insert (piping_class, constn_area, pip_iso_no, sheet_no, rev_no, priority_no, priority_timing, constn_unit, unit_area, insul_lm, lb_sb, tp_no, tp_type_of_test, linear_total_lm, loguser, logdate, logtime, logupdate)
						values (src.piping_class, src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.priority_no, src.priority_timing, src.constn_unit, src.unit_area, src.insul_lm, src.tp_no, src.lb_sb, src.tp_type_of_test, src.total_length, user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
					output $action into @action;
										
					if ((select change from @action) = ''INSERT'')
					begin
						update t set spoolgen_prep = (t.spoolgen_prep + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/'')))) t
						where t.Rn = 1
					end
					
					if (@spool_no != ''ERECTION'' and @spool_no != '''')
					begin
						update t set linear_shop = (t.linear_shop + @total_length)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/'')))) t
						where t.Rn = 1
						
						delete from @action;
						merge dbo.tttpspl as target
						using (select (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end),
							@spool_no, ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))), @piping_class,
							@constn_area, @unit_area, @sheet_no, @rev_no, @spool_no1,
							@tp_type_of_test, @priority_no, @priority_timing, @pipmto_lb_sb,
							@spool_category, @field_desc, @total_length) as src
							(pip_iso_no, spool_no, tp_no, piping_class, constn_area, unit_area, sheet_no, rev_no, spool_no1, tp_type_of_test, priority_no, priority_timing, lb_sb, spool_category, field_desc, total_length)
						on (target.pip_iso_no = src.pip_iso_no and
							target.spool_no = src.spool_no and
							target.tp_no = src.tp_no)
						when matched then
							update set lb_sb = (case when (target.lb_sb = ''SB'' and src.lb_sb = ''LB'') then src.lb_sb else target.lb_sb end),
									   linear_shop = (target.linear_shop + src.total_length),
									   linear_total_lm = (target.linear_total_lm + src.total_length)
						when not matched then
							insert (piping_class, constn_unit, pip_iso_no, sys_no, sheet_no, rev_no, spool_no, spool_no1, tp_no, tp_type_of_test, priority_no, priority_timing, constn_area, unit_area, lb_sb, spool_category, field_desc, linear_shop, linear_total_lm, loguser, logdate, logtime, logupdate)
							values(src.piping_class, src.constn_area, src.pip_iso_no, src.unit_area, src.sheet_no, src.rev_no, src.spool_no, src.spool_no1, src.tp_no, src.tp_type_of_test, src.priority_no, src.priority_timing, src.constn_area, src.unit_area, src.lb_sb, src.spool_category, src.field_desc, src.total_length, src.total_length, user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
						output $action into @action;
						
						if ((select change from @action) = ''INSERT'')
						begin
							update t set spool_qty = (t.spool_qty + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/'')))) t
							where t.Rn = 1
						end
					end
					else
					begin
						update t set linear_field = (t.linear_field + @total_length)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/'')))) t
						where t.Rn = 1
					end
					
					update t set linear_total_lm = (t.linear_total_lm + @total_length)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/'')))) t
					where t.Rn = 1
					
					set @i += 1;
				end
			end
			else
			begin
				-- proc_internal_tbl2-2
				delete from @action;
				merge tttp as target
				using (select @piping_class, @tp_no, @tp_type_of_test, @tp_priority_no, @tp_priority_timing, @unit_area) as src
					(piping_class, tp_no, tp_type_of_test, tp_priority_no, tp_priority_timing, unit_area)
				on (target.piping_class = src.piping_class and
					target.tp_no = src.tp_no)
				when not matched then
					insert (piping_class, tp_no, tp_type_of_test, priority_no, priority_timing, constn_unit, loguser, logdate, logtime, logupdate)
					values(src.piping_class, src.tp_no, src.tp_type_of_test, src.tp_priority_no, src.tp_priority_timing, src.unit_area, user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
				output $action into @action;
				
				if ((select change from @action) = ''INSERT'')
				begin
					merge @tttptt as target
					using (select @tp_no, @tp_type_of_test) as src
						(tp_no, tp_type_of_test)
					on (target.tp_no = src.tp_no and
						target.test_type = src.tp_type_of_test)
					when not matched then
						insert (tp_no, test_type)
						values(src.tp_no, src.tp_type_of_test);
							
					update t set total_tp = (t.total_tp + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm) t
					where t.Rn = 1
					
					if (@piping_class = ''A/G'')
					begin
						update t set total_tp = (t.total_tp + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag) t
						where t.Rn = 1
						
						delete from @action;
						merge dbo.ttsubsys_ag as target
						using (select @unit_area, substring(ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))),1, 7)) as src
							(unit_area, tp_no)
						on (target.sys_no = src.unit_area and
							target.subsys_no = src.tp_no and
							target.piping_class = ''A/G'')
						when not matched then
							insert (sys_no, subsys_no, piping_class, datasource, loguser, logdate, logtime, logupdate)
							values (src.unit_area, src.tp_no, ''A/G'', ''pip_mto_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
						output $action into @action;
						
						if ((select change from @action) = ''INSERT'')
						begin
							update t set total_subsys = (t.total_subsys + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag) t
							where t.Rn = 1								
						end
					end
					if (@piping_class = ''U/G'')
					begin
						update t set total_tp = (t.total_tp + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug) t
						where t.Rn = 1						
						
						delete from @action;
						merge dbo.ttsubsys_ug as target
						using (select @unit_area, substring(ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))),1, 7)) as src
							(unit_area, tp_no)
						on (target.sys_no = src.unit_area and
							target.subsys_no = src.tp_no and
							target.piping_class = ''U/G'')
						when not matched then
							insert (sys_no, subsys_no, piping_class, datasource, loguser, logdate, logtime, logupdate)
							values (src.unit_area, src.tp_no, ''U/G'', ''pip_mto_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
						output $action into @action;
						
						if ((select change from @action) = ''INSERT'')
						begin
							update t set total_subsys = (t.total_subsys + 1)
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug) t
							where t.Rn = 1								
						end
					end
						
					merge dbo.ttConstn as target
					using (select @piping_class, @priority_no, @priority_timing, @constn_area, @unit_area, @tp_type_of_test) as src
						  (piping_class, priority_no, priority_timing, constn_area, unit_area, tp_type_of_test)
					on (target.piping_class = src.piping_class and 
						target.priority_no = src.priority_no and 
						target.priority_timing = src.priority_timing and 
						target.constn_unit = src.constn_area and 
						target.unit_area = src.unit_area)
					when matched then
						update set testpack_prep = (testpack_prep + 1),
								   tp_type_h = (case when (charindex(''H'',src.tp_type_of_test,1) = 1) then (tp_type_h + 1) else (tp_type_h) end),
								   tp_type_s = (case when (charindex(''S'',src.tp_type_of_test,1) = 1) then (tp_type_s + 1) else (tp_type_s) end),
								   tp_type_v = (case when (charindex(''V'',src.tp_type_of_test,1) = 1) then (tp_type_v + 1) else (tp_type_v) end),
								   tp_type_c = (case when (charindex(''C'',src.tp_type_of_test,1) = 1) then (tp_type_c + 1) else (tp_type_c) end);							
							
					delete from @action;	   
					merge dbo.ttsubsys as target
					using (select @unit_area, substring(ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))),1, 7)) as src
						(unit_area, tp_no)
					on (target.sys_no = src.unit_area and
						target.subsys_no = src.tp_no)
					when not matched then
						insert (sys_no, subsys_no, datasource, loguser, logdate, logtime, logupdate)
						values(src.unit_area, src.tp_no, ''pip_mto_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
					output $action into @action;
						
					if ((select change from @action) = ''INSERT'')
					begin
						update t set total_subsys = (t.total_subsys + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm) t
						where t.Rn = 1								
					end
				end
				else
				begin
					merge @tttptt as target
					using (select ltrim(rtrim(dbo.entry_fn(@i,@tp_no,''/''))), @tp_type_of_test) as src
						(tp_no, tp_type_of_test)
					on (target.tp_no = src.tp_no and
						target.test_type = src.tp_type_of_test)
					when not matched then
						insert (tp_no, test_type)
						values (src.tp_no, src.tp_type_of_test);
					
					update t4 set tp_type_of_test = (case when (t4.tp_type_of_test = '''') then (t4.tp_type_of_test + ''/'' + t3.test_type) else '''' end)
						from dbo.tttp t4 inner join (
							select t2.*,t.test_type from @ttTPTT t inner join (
								select top 1 * from dbo.tttp order by PROGRESS_RECID desc
							) t2
							on t.tp_no = t2.tp_no
						) t3 on t4.PROGRESS_RECID = t3.PROGRESS_RECID					
				end
					
				merge dbo.tttpiso as target
				using (select @piping_class, @constn_area, 
					(case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end),
					@sheet_no, @rev_no, @tp_no, @priority_no,
					@priority_timing, @constn_area, @unit_area, (@insul_lm_untraced + @insul_lm_traced),
					@pipmto_lb_sb, @tp_type_of_test, @total_length, @iso_lb_sb, @spool_no) as src
					(piping_class, constn_area, pip_iso_no, sheet_no, rev_no, tp_no, priority_no, priority_timing, constn_unit, unit_area, insul_lm, lb_sb, tp_type_of_test, total_length, iso_lb_sb, spool_no)
				on (target.piping_class = src.piping_class and
					target.constn_area = src.constn_area and
					target.pip_iso_no = src.pip_iso_no and
					target.sheet_no = src.sheet_no and
					target.rev_no = src.rev_no and
					target.tp_no = src.tp_no)
				when matched then
					update set insul_lm = (target.insul_lm + (src.insul_lm)),
							   lb_sb = (case when (target.lb_sb = ''SB'' and src.iso_lb_sb = ''LB'') then src.iso_lb_sb else target.lb_sb end),
							   linear_shop = (case when (@spool_no != ''ERECTION'' and @spool_no != '''') then (target.linear_shop + src.total_length) else target.linear_shop end),
							   linear_total_lm = (target.linear_total_lm + src.total_length)
				when not matched then
					insert (piping_class, constn_area, pip_iso_no, sheet_no, rev_no, priority_no, priority_timing, constn_unit, unit_area, insul_lm, lb_sb, tp_no, tp_type_of_test, linear_total_lm, linear_shop, loguser, logdate, logtime, logupdate)
					values (src.piping_class, src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.priority_no, src.priority_timing, src.constn_unit, src.unit_area, src.insul_lm, src.tp_no, src.lb_sb, src.tp_type_of_test, src.total_length,(case when (src.spool_no != ''ERECTION'' and src.spool_no != '''') then src.total_length else 0 end), user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
				output $action into @action;
									
				if ((select change from @action) = ''INSERT'')
				begin
					update t set spoolgen_prep = (t.spoolgen_prep + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no) t
					where t.Rn = 1
				end
				
				if (@spool_no != ''ERECTION'' and @spool_no != '''')
				begin
					update t set linear_shop = (t.linear_shop + @total_length)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no) t
					where t.Rn = 1
					
					delete from @action;
					merge dbo.tttpspl as target
					using (select (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end),
						@spool_no, @tp_no, @piping_class,
						@constn_area, @unit_area, @sheet_no, @rev_no, @spool_no1,
						@tp_type_of_test, @priority_no, @priority_timing, @pipmto_lb_sb,
						@spool_category, @field_desc, @total_length) as src
						(pip_iso_no, spool_no, tp_no, piping_class, constn_area, unit_area, sheet_no, rev_no, spool_no1, tp_type_of_test, priority_no, priority_timing, lb_sb, spool_category, field_desc, total_length)
					on (target.pip_iso_no = src.pip_iso_no and
						target.spool_no = src.spool_no and
						target.tp_no = src.tp_no)
					when matched then
						update set lb_sb = (case when (target.lb_sb = ''SB'' and src.lb_sb = ''LB'') then src.lb_sb else target.lb_sb end),
								   linear_shop = (target.linear_shop + src.total_length),
								   linear_total_lm = (target.linear_total_lm + src.total_length)
					when not matched then
						insert (piping_class, constn_unit, pip_iso_no, sys_no, sheet_no, rev_no, spool_no, spool_no1, tp_no, tp_type_of_test, priority_no, priority_timing, constn_area, unit_area, lb_sb, spool_category, field_desc, linear_shop, linear_total_lm, loguser, logdate, logtime, logupdate)
						values(src.piping_class, src.constn_area, src.pip_iso_no, src.unit_area, src.sheet_no, src.rev_no, src.spool_no, src.spool_no1, src.tp_no, src.tp_type_of_test, src.priority_no, src.priority_timing, src.constn_area, src.unit_area, src.lb_sb, src.spool_category, src.field_desc, src.total_length, src.total_length, user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping MTO Data'')
					output $action into @action;
					
					if ((select change from @action) = ''INSERT'')
					begin
						update t set spool_qty = (t.spool_qty + 1)
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no) t
						where t.Rn = 1
					end
				end
				else
				begin
					update t set linear_field = (t.linear_field + @total_length)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no) t
					where t.Rn = 1
				end
					
				update t set linear_total_lm = (t.linear_total_lm + @total_length)
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no) t
				where t.Rn = 1
			end
		end	
		
		fetch next from crs into @tp_no, @tp_type_of_test, @piping_class, @area_desc, @field_desc, @priority_timing, @priority_no, @unit_area, @constn_area, 
		@pip_iso_no, @sheet_no, @rev_no, @insul_lm_untraced, @insul_lm_traced, @iso_lb_sb, @pipmto_lb_sb, @spool_no, @client_dwg_no, @line_no, @line_class,
		@material, @item_code, @spool_category, @size, @group_size, @qty, @item_no, @fitting_length, @total_length, @bolt_length, @group_1, @group_2, 
		@mat_description, @painting_specs, @insul_type, @insul_thk, @insul_pipe_size, @tp_f_s, @total_sheets, @painting_primer_s, @painting_top_coat_s,
		@file_origin, @spool_no1, @tp_priority_no, @tp_priority_timing, @pip_iso_no1
	end
	close crs
	deallocate crs
	
	--proc_internal_tbl3
		
	declare crs_tt cursor read_only
		for select piping_class, tp_no, lb_sb from dbo.pip_mto_data
				
	open crs_tt
	fetch next from crs_tt into @piping_class, @tp_no, @lb_sb
	while @@FETCH_STATUS = 0
	begin
		merge dbo.tttestpack as target
		using (select @piping_class, @tp_no, @lb_sb) as src
			(piping_class, tp_no, lb_sb)
		on (target.piping_class = src.piping_class and
			target.tp_no = src.tp_no)
		when matched then
			update set spool_qty_lb = (case when (src.lb_sb = ''LB'') then (target.spool_qty_lb + 1) else target.spool_qty_lb end),
					   spool_qty_sb = (case when (src.lb_sb = ''SB'') then (target.spool_qty_sb + 1) else target.spool_qty_sb end);
					   
		fetch next from crs_tt into @piping_class, @tp_no, @lb_sb
	end
	close crs_tt
	deallocate crs_tt

    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[isoMQ1_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[isoMQ1_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[isoMQ1_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	declare @action TABLE(change VARCHAR(20))
	SET NOCOUNT ON;

	begin transaction;
	
	delete from dbo.ttad;
	delete from dbo.ttconstn;
	delete from dbo.ttfd;
	delete from dbo.ttinsl;
	delete from dbo.ttiso;
	delete from dbo.ttmatl_e;
	delete from dbo.ttmatl_s;
	delete from dbo.ttmngtsumm;
	delete from dbo.ttmngtsumm_ag;
	delete from dbo.ttmngtsumm_ug;
	delete from dbo.ttpc;
	delete from dbo.ttpn;
	delete from dbo.ttpnt;
	delete from dbo.ttpt;
	delete from dbo.ttspl;
	delete from dbo.ttsys;
	delete from dbo.ttsys_ag;
	delete from dbo.ttsys_ug;
	delete from dbo.tttestpack;
	
	declare @ttmngtsumm_lastid as int
	declare @ttmngtsumm_ag_lastid as int
	declare @ttmngtsumm_ug_lastid as int
	
	insert into dbo.ttmngtsumm(maintenance, loguser, logdate, logtime, logupdate)
		values(1,USER,{fn NOW()}, convert(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'');	
	set @ttmngtsumm_lastid = scope_identity();
		
	insert into dbo.ttmngtsumm_ag(piping_class, loguser, logdate, logtime, logupdate)
		values(''A/G'',USER,{fn NOW()}, convert(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'');
	set @ttmngtsumm_ag_lastid = scope_identity();
		
	insert into dbo.ttmngtsumm_ug(piping_class, loguser, logdate, logtime, logupdate)
		values(''U/G'',USER,{fn NOW()}, convert(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'');
	set @ttmngtsumm_ug_lastid = scope_identity();

	declare @ttconstn_lastid as int
	-- proc_internal_tbl1
	merge dbo.ttconstn as target
	using (select t.piping_class, t.priority_no, t.priority_timing,
			t.constn_area, t.unit_area, t.area_desc, ''pip_mto_data'', USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'' from dbo.pip_mto_data as t) as src
		  (piping_class, priority_no, priority_timing, 
			constn_area, unit_area, area_desc, datasource, loguser, logdate, logtime, logupdate)
	on (target.piping_class = src.piping_class and
		target.priority_no = src.priority_no and
		target.priority_timing = src.priority_timing and
		target.constn_unit = src.constn_area and
		target.unit_area = src.unit_area)
	when not matched then
		insert (piping_class, priority_no, priority_timing, 
			constn_unit, unit_area, area_desc, datasource, loguser, logdate, logtime, logupdate)
		values(src.piping_class, src.priority_no, src.priority_timing, 
			src.constn_area, src.unit_area, src.area_desc, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate);
	set @ttconstn_lastid = SCOPE_IDENTITY();

	declare @i as int
	declare @pip_iso_no as varchar(max)	
	declare @tp_no as varchar(max)
	declare @tp_type_of_test as varchar(max)
	declare @piping_class as varchar(max)
	declare @area_desc as varchar(max)
	declare @field_desc as varchar(max)
	declare @priority_timing as varchar(max)
	declare @priority_no as varchar(max)
	declare @unit_area as varchar(max)
	declare @constn_area as varchar(max)
	declare @sheet_no as varchar(max)
	declare @rev_no as varchar(max)
	declare @insul_lm_untraced as decimal(19, 4)
	declare @insul_lm_traced as decimal(19, 4)
	declare @iso_lb_sb as varchar(max)
	declare @pipmto_lb_sb as varchar(max)
	declare @spool_no as varchar(max)	
	declare @client_dwg_no as varchar(max)
	declare @line_no as varchar(max)
	declare @line_class as varchar(max)
	declare @material as varchar(max)
	declare @item_code as varchar(max)
	declare @spool_category as varchar(max)
	declare @size as varchar(max)
	declare @group_size as varchar(max)
	declare @qty as decimal(19, 4)
	declare @item_no as varchar(max)
	declare @fitting_length as decimal(19, 4)
	declare @total_length as decimal(19, 4)
	declare @bolt_length as decimal(19, 4)
	declare @group_1 as varchar(max)
	declare @group_2 as varchar(max)
	declare @mat_description as varchar(max)
	declare @painting_specs as varchar(max)			
	declare @insul_type as varchar(max)
	declare @insul_thk as varchar(max)
	declare @insul_pipe_size as varchar(max)
	declare @tp_f_s as varchar(max)
	declare @total_sheets as varchar(max)			
	declare @painting_primer_s as decimal(19, 4)
	declare @painting_top_coat_s as decimal(19, 4)
	declare @file_origin as varchar(max)
	declare @spool_no1 as varchar(max)
	declare @pip_iso_no1 as varchar(max)
	declare crs cursor read_only
		for select tp_no, tp_type_of_test, piping_class, area_desc, field_desc, priority_timing, priority_no, unit_area,
			constn_area, pip_iso_no, sheet_no, rev_no, insul_lm_untraced, insul_lm_traced, iso_lb_sb, lb_sb, spool_no,
			client_dwg_no, line_no, line_class, material, item_code, spool_category, size, group_size, qty, item_no, 
			fitting_length, total_length, bolt_length, group_1, group_2, mat_description, painting_specs,
			insul_type, insul_thk, insul_pipe_size, tp_f_s, total_sheets, painting_primer_s, painting_top_coat_s,
			file_origin, spool_no1, 
			(case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) from dbo.pip_mto_data
				
	open crs
	fetch next from crs into @tp_no, @tp_type_of_test, @piping_class, @area_desc, @field_desc, @priority_timing, @priority_no, @unit_area, @constn_area, 
		@pip_iso_no, @sheet_no, @rev_no, @insul_lm_untraced, @insul_lm_traced, @iso_lb_sb, @pipmto_lb_sb, @spool_no, @client_dwg_no, @line_no, @line_class,
		@material, @item_code, @spool_category, @size, @group_size, @qty, @item_no, @fitting_length, @total_length, @bolt_length, @group_1, @group_2, 
		@mat_description, @painting_specs, @insul_type, @insul_thk, @insul_pipe_size, @tp_f_s, @total_sheets, @painting_primer_s, @painting_top_coat_s,
		@file_origin, @spool_no1, @pip_iso_no1
	while @@FETCH_STATUS = 0
	begin
		if @tp_no = '''' and (charindex(''H'',@tp_type_of_test,1) = 1 or charindex(''S'',@tp_type_of_test,1) = 1 or charindex(''V'',@tp_type_of_test,1) = 1 or charindex(''C'',@tp_type_of_test,1) = 1)
		begin
			declare @numEntries as int
			set @numEntries = qms_pip.dbo.num_entries_fn(@tp_no,''/'')
			if @numEntries > 0
			begin
				set @i = 1;
				while @i < @numEntries
				begin
					merge dbo.ttTestpack as target
					-- using (select t.piping_class, t.priority_no, t.priority_timing, t.unit_area, t.area_desc, qms_pip.dbo.entry_fn(@i,@tp_no,'',''), ''pip_mto_data'', USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'' from dbo.pip_mto_data as t) as src
					using (select @piping_class, @priority_no, @priority_timing,
							@unit_area, @area_desc, @tp_no, ''pip_mto_data'', USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'') as src
						  (piping_class, priority_no, priority_timing, 
							unit_area, area_desc, tp_no, datasource, loguser, logdate, logtime, logupdate)
					on (target.piping_class = src.piping_class and
						target.priority_no = src.tp_no)
					when not matched then
						insert (piping_class, priority_no, priority_timing, 
							constn_unit, area_desc, tp_no, datasource, loguser, logdate, logtime, logupdate)
						values(src.piping_class, src.priority_no, src.priority_timing, 
							src.unit_area, src.area_desc, src.tp_no, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate);
					set @i += 1;
				end
			end		
		end
		else
		begin
			merge dbo.ttTestpack as target
			using (select @piping_class, @priority_no, @priority_timing,
					@unit_area, @area_desc, qms_pip.dbo.entry_fn(@i,@tp_no,''/''), ''pip_mto_data'', USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'') as src
				  (piping_class, priority_no, priority_timing, 
					unit_area, area_desc, tp_no, datasource, loguser, logdate, logtime, logupdate)
			on (target.piping_class = src.piping_class and
				target.priority_no = src.tp_no)
			when not matched then
				insert (piping_class, priority_no, priority_timing, 
					constn_unit, area_desc, tp_no, datasource, loguser, logdate, logtime, logupdate)
				values(src.piping_class, src.priority_no, src.priority_timing, 
					src.unit_area, src.area_desc, src.tp_no, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate);
		end
		
		if (@piping_class != '''')
		begin
			merge dbo.ttPC as target
			using (select @piping_class, ''pip_mto_data'', USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'') as src
				  (piping_class, datasource, loguser, logdate, logtime, logupdate)
			on (target.piping_class = src.piping_class)
			when not matched then
				insert (piping_class, datasource, loguser, logdate, logtime, logupdate)
				values(src.piping_class, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate);
		end
		
		if (@priority_no != '''')
		begin
			merge dbo.ttPN as target
			using (select @priority_no, ''pip_mto_data'', USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'') as src
				  (priority_no, datasource, loguser, logdate, logtime, logupdate)
			on (target.priority_no = src.priority_no)
			when not matched then
				insert (priority_no, datasource, loguser, logdate, logtime, logupdate)
				values(src.priority_no, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate);
		end
		
		if (@priority_timing != '''')
		begin
			merge dbo.ttPT as target
			using (select @priority_timing, ''pip_mto_data'', USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'') as src
				  (priority_timing, datasource, loguser, logdate, logtime, logupdate)
			on (target.priority_timing = src.priority_timing)
			when not matched then
				insert (priority_timing, datasource, loguser, logdate, logtime, logupdate)
				values(src.priority_timing, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate);
		end
		
		if (@field_desc != '''')
		begin
			merge dbo.ttFD as target
			using (select @field_desc, ''pip_mto_data'', USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'') as src
				  (field_desc, datasource, loguser, logdate, logtime, logupdate)
			on (target.field_desc = src.field_desc)
			when not matched then
				insert (field_desc, datasource, loguser, logdate, logtime, logupdate)
				values(src.field_desc, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate);
		end
		
		if (@area_desc != '''')
		begin
			merge dbo.ttAD as target
			using (select @area_desc, ''pip_mto_data'', USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'') as src
				  (area_desc, datasource, loguser, logdate, logtime, logupdate)
			on (target.area_desc = src.area_desc)
			when not matched then
				insert (area_desc, datasource, loguser, logdate, logtime, logupdate)
				values(src.area_desc, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate);
		end
		
		-- proc_internal_tbl1-1
				
		merge dbo.ttISO as target
		using (select @piping_class, @constn_area,
				(case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end), 
				@sheet_no, @rev_no, @priority_no, @priority_timing, @unit_area, 
				(@insul_lm_untraced + @insul_lm_traced), @iso_lb_sb, USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'') as src
			  (piping_class, constn_area, pip_iso_no, sheet_no, rev_no, priority_no, priority_timing, unit_area, insul_lm, lb_sb, loguser, logdate, logtime, logupdate)
		on (target.piping_class = src.piping_class and
			target.constn_area = src.constn_area and
			target.pip_iso_no = src.pip_iso_no and
			target.sheet_no = src.sheet_no and
			target.rev_no = src.rev_no)
		when matched then
			update set insul_lm = (target.insul_lm + src.insul_lm)
		when not matched then
			insert (piping_class, constn_area, pip_iso_no, sheet_no, rev_no, priority_no, priority_timing, constn_unit, unit_area, insul_lm, lb_sb, loguser, logdate, logtime, logupdate)
			values(src.piping_class, src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.priority_no, src.priority_timing, src.constn_area, src.unit_area, src.insul_lm, src.lb_sb, src.loguser, src.logdate, src.logtime, src.logupdate);
			
		declare @lb_sb as varchar(max)
		declare @ttiso_lastid as bigint
		declare crs_tt cursor read_only
			for select lb_sb, PROGRESS_RECID from dbo.ttiso
			
		open crs_tt
		fetch next from crs_tt into @lb_sb, @ttiso_lastid
		while @@FETCH_STATUS = 0
		begin
			update dbo.ttmngtsumm set total_iso = (t.total_iso + 1)
				from dbo.ttmngtsumm as t
				where t.PROGRESS_RECID = @ttmngtsumm_lastid
				
			if (@piping_class = ''A/G'')
				update dbo.ttmngtsumm_ag set total_iso = (t.total_iso + 1)
					from dbo.ttmngtsumm_ag as t
					where t.PROGRESS_RECID = @ttmngtsumm_ag_lastid
				
			if (@piping_class = ''U/G'')
				update dbo.ttmngtsumm_ug set total_iso = (t.total_iso + 1)
					from dbo.ttmngtsumm_ug as t
					where t.PROGRESS_RECID = @ttmngtsumm_ug_lastid
					
			update dbo.ttconstn set spoolgen_prep = (t.spoolgen_prep + 1)
				from dbo.ttconstn as t
				where t.PROGRESS_RECID = @ttconstn_lastid
				
			if (@iso_lb_sb = ''LB'')
				update dbo.ttconstn set spoolgen_prep_lb = (t.spoolgen_prep_lb + 1)
					from dbo.ttconstn as t
					where t.PROGRESS_RECID = @ttconstn_lastid
				
			if (@iso_lb_sb = ''SB'')
				update dbo.ttconstn set spoolgen_prep_sb = (t.spoolgen_prep_sb + 1)
					from dbo.ttconstn as t
					where t.PROGRESS_RECID = @ttconstn_lastid
			
			if (@lb_sb = ''SB'' and @iso_lb_sb = ''LB'')
			begin
				update dbo.ttiso set lb_sb = @pipmto_lb_sb
					from dbo.ttiso as t
					where t.PROGRESS_RECID = @ttiso_lastid
				
				update dbo.ttconstn set spoolgen_prep_sb = (t.spoolgen_prep_sb - 1)
					from dbo.ttconstn as t
					where t.PROGRESS_RECID = @ttconstn_lastid
				update dbo.ttconstn set spoolgen_prep_lb = (t.spoolgen_prep_lb + 1)
					from dbo.ttconstn as t
					where t.PROGRESS_RECID = @ttconstn_lastid
			end
			
			fetch next from crs_tt into @lb_sb, @ttiso_lastid
		end
		close crs_tt
		deallocate crs_tt
		
		IF ((@insul_lm_untraced != 0 AND @insul_lm_traced != 0) OR
			(@insul_lm_untraced != 0 and @insul_lm_traced = 0) OR
			(@insul_lm_untraced = 0 and @insul_lm_traced != 0))
		begin				
			declare @ttinsl_lastid as bigint
			merge dbo.ttinsl as target
			using (select @piping_class, @constn_area,
					(case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end), 
					@sheet_no, @rev_no, @priority_no, @priority_timing, @unit_area, 
					USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'') as src
				  (piping_class, constn_area, pip_iso_no, sheet_no, rev_no, priority_no, priority_timing, unit_area, loguser, logdate, logtime, logupdate)
			on (target.piping_class = src.piping_class and
				target.constn_area = src.constn_area and
				target.pip_iso_no = src.pip_iso_no and
				target.sheet_no = src.sheet_no and
				target.rev_no = src.rev_no)
			when not matched then
				insert (piping_class, constn_area, pip_iso_no, sheet_no, rev_no, priority_no, priority_timing, constn_unit, unit_area, loguser, logdate, logtime, logupdate)
				values(src.piping_class, src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.priority_no, src.priority_timing, src.constn_area, src.unit_area, src.loguser, src.logdate, src.logtime, src.logupdate);
			set @ttinsl_lastid = SCOPE_IDENTITY();
				
			update dbo.ttconstn set insul_lm = (t.insul_lm + (@insul_lm_untraced + @insul_lm_traced))
				from dbo.ttconstn as t
				where t.PROGRESS_RECID = @ttconstn_lastid			
				
			if (@insul_lm_untraced != 0)
				update dbo.ttinsl set insul_lm_untraced = (t.insul_lm_untraced + @insul_lm_untraced)
					from dbo.ttinsl as t
					where t.PROGRESS_RECID = @ttinsl_lastid
			if (@insul_lm_traced != 0)
				update dbo.ttinsl set insul_lm_traced = (t.insul_lm_traced + @insul_lm_traced)
					from dbo.ttinsl as t
					where t.PROGRESS_RECID = @ttinsl_lastid
		end
		
		if (@spool_no != ''ERECTION'' and @spool_no != '''')
		begin
			insert into dbo.ttmatl_s
				select @pip_iso_no, @client_dwg_no, @constn_area, @lb_sb,
					@sheet_no, @rev_no, @line_no, @line_class, @material,
					@item_code, @spool_category, @spool_no, @size, @group_size,
					@qty, @item_no, @fitting_length, @total_length, @bolt_length,
					@group_1, @group_2, @mat_description, @painting_specs, @insul_type,
					@insul_thk, @insul_pipe_size, @insul_lm_untraced, @insul_lm_traced,
					@tp_no, @tp_type_of_test, @tp_f_s, @priority_timing, @priority_no,
					@piping_class, @total_sheets, @field_desc, @area_desc, @painting_primer_s,
					@painting_top_coat_s, USER, {fn NOW()}, CONVERT(time,current_timestamp),
					''Upload Piping MTO Data'', @file_origin, @spool_no1, @unit_area, @pip_iso_no1,
					'''', '''', '''',0,0
					
			update dbo.ttconstn set linear_shop = (t.linear_shop + @total_length)
				from dbo.ttconstn as t
				where t.PROGRESS_RECID = @ttconstn_lastid
						
			update dbo.ttiso set linear_shop = (t.linear_shop + @total_length)
				from dbo.ttiso as t
				where t.PROGRESS_RECID = @ttconstn_lastid
				
			if (@iso_lb_sb = ''LB'')		
				update dbo.ttconstn set linear_shop_lb = (t.linear_shop_lb + @total_length)
					from dbo.ttconstn as t
					where t.PROGRESS_RECID = @ttconstn_lastid
			if (@iso_lb_sb = ''SB'')		
				update dbo.ttconstn set linear_shop_sb = (t.linear_shop_sb + @total_length)
					from dbo.ttconstn as t
					where t.PROGRESS_RECID = @ttconstn_lastid
			
			update dbo.ttmngtsumm set total_lm_s = (t.total_lm_s + @total_length)
				from dbo.ttmngtsumm as t
				where t.PROGRESS_RECID = @ttmngtsumm_lastid
				
			if (@piping_class = ''A/G'')
				update dbo.ttmngtsumm_ag set total_lm_s = (t.total_lm_s + @total_length)
					from dbo.ttmngtsumm_ag as t
					where t.PROGRESS_RECID = @ttmngtsumm_ag_lastid
				
			if (@piping_class = ''U/G'')
				update dbo.ttmngtsumm_ug set total_lm_s = (t.total_lm_s + @total_length)
					from dbo.ttmngtsumm_ug as t
					where t.PROGRESS_RECID = @ttmngtsumm_ug_lastid
							
			delete from @action;	
			merge dbo.ttSPL as target
			using (select @piping_class, @constn_area,
					(case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end), 
					@sheet_no, @rev_no, @priority_no, @priority_timing, @unit_area, @spool_no,
					(@insul_lm_untraced + @insul_lm_traced), @iso_lb_sb, @spool_no1, @spool_category, @field_desc, @total_length, USER, {fn NOW()}, CONVERT(time,CURRENT_TIMESTAMP), ''Upload Piping MTO Data'') as src
				  (piping_class, constn_area, pip_iso_no, sheet_no, rev_no, priority_no, priority_timing, unit_area, spool_no, insul_lm, lb_sb, spool_no1, spool_category, field_desc, total_length, loguser, logdate, logtime, logupdate)
			on (target.pip_iso_no = src.pip_iso_no and
				target.spool_no = src.spool_no)
			when matched then
				update set lb_sb = (case when (target.lb_sb = ''SB'' and @lb_sb = ''LB'') then @lb_sb else target.lb_sb end),
						   linear_shop = (target.linear_shop + src.total_length),
						   linear_total_lm = (target.linear_total_lm + src.total_length)
			when not matched then
				insert (piping_class, constn_area, pip_iso_no, sys_no, sheet_no, rev_no, spool_no, spool_no1, priority_no, priority_timing, constn_unit, unit_area, lb_sb, spool_category, field_desc, linear_shop, linear_total_lm, loguser, logdate, logtime, logupdate)
				values(src.piping_class, src.constn_area, src.pip_iso_no, src.unit_area, src.sheet_no, src.rev_no, src.spool_no, src.spool_no1, src.priority_no, src.priority_timing, src.constn_area, src.unit_area, src.lb_sb, src.spool_category, src.field_desc, src.total_length, src.total_length, src.loguser, src.logdate, src.logtime, src.logupdate)
			output $action into @action;
				
			if ((select change from @action) = ''INSERT'')
			begin
				declare @recid_ttspl bigint
				declare crs_tt1 cursor read_only
					for select PROGRESS_RECID from dbo.ttSPL
					
				open crs_tt1
				fetch next from crs_tt1 into @recid_ttspl
				while @@FETCH_STATUS = 0
				begin
					if (@piping_class = ''A/G'')
					begin
						merge dbo.ttsys_ag as target
						using (select @unit_area, @piping_class, ''pip_mto_dta'', User, {fn NOW()}, convert(time,current_timestamp), ''Upload Piping MTO Data'') as src
							(unit_area, piping_class, datasource, loguser, logdate, logtime, logupdate)
						on (target.sys_no = src.unit_area and
							target.piping_class = src.piping_class)
						when not matched then
							insert (sys_no, piping_class, datasource, loguser, logdate, logtime, logupdate)
							values (src.unit_area, src.piping_class, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate);
												
						update dbo.ttmngtsumm_ag set total_sys = (t.total_sys + 1)
							from dbo.ttmngtsumm_ag as t
							where t.PROGRESS_RECID = @ttmngtsumm_ag_lastid
					end
					else if (@piping_class = ''U/G'')
					begin
						merge dbo.ttsys_ug as target
						using (select @unit_area, @piping_class, ''pip_mto_dta'', User, {fn NOW()}, convert(time,current_timestamp), ''Upload Piping MTO Data'') as src
							(unit_area, piping_class, datasource, loguser, logdate, logtime, logupdate)
						on (target.sys_no = src.unit_area and
							target.piping_class = src.piping_class)
						when not matched then
							insert (sys_no, piping_class, datasource, loguser, logdate, logtime, logupdate)
							values (src.unit_area, src.piping_class, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate);
												
						update dbo.ttmngtsumm_ug set total_sys = (t.total_sys + 1)
							from dbo.ttmngtsumm_ug as t
							where t.PROGRESS_RECID = @ttmngtsumm_ag_lastid
					end
									
					delete from @action;
					merge dbo.ttsys as target
					using (select @unit_area, ''pip_mto_dta'', User, {fn NOW()}, convert(time,current_timestamp), ''Upload Piping MTO Data'') as src
						(unit_area, datasource, loguser, logdate, logtime, logupdate)
					on (target.sys_no = src.unit_area)
					when not matched then
						insert (sys_no, datasource, loguser, logdate, logtime, logupdate)
						values (src.unit_area, src.datasource, src.loguser, src.logdate, src.logtime, src.logupdate)
					output $action into @action;
						
					if ((select change from @action) = ''INSERT'')
						update dbo.ttmngtsumm_ug set total_sys = (t.total_sys + 1)
							from dbo.ttmngtsumm_ug as t
							where t.PROGRESS_RECID = @ttmngtsumm_ag_lastid
														
					update dbo.ttmngtsumm set total_spl = (t.total_spl + 1)
						from dbo.ttmngtsumm as t
						where t.PROGRESS_RECID = @ttmngtsumm_lastid
						
					if (@piping_class = ''A/G'')
						update dbo.ttmngtsumm_ag set total_spl = (t.total_spl + 1)
							from dbo.ttmngtsumm_ag as t
							where t.PROGRESS_RECID = @ttmngtsumm_ag_lastid
						
					if (@piping_class = ''U/G'')
						update dbo.ttmngtsumm_ug set total_spl = (t.total_spl + 1)
							from dbo.ttmngtsumm_ug as t
							where t.PROGRESS_RECID = @ttmngtsumm_ug_lastid
							
					update dbo.ttconstn set spool_qty = (t.spool_qty + 1)
						from dbo.ttconstn as t
						where t.PROGRESS_RECID = @ttconstn_lastid
						
					if (@iso_lb_sb = ''LB'')
						update dbo.ttconstn set spool_qty_lb = (t.spool_qty_lb + 1)
							from dbo.ttconstn as t
							where t.PROGRESS_RECID = @ttconstn_lastid
					if (@iso_lb_sb = ''SB'')
						update dbo.ttconstn set spool_qty_sb = (t.spool_qty_sb + 1)
							from dbo.ttconstn as t
							where t.PROGRESS_RECID = @ttconstn_lastid
							
					fetch next from crs_tt1 into @recid_ttspl
				end
				close crs_tt1
				deallocate crs_tt1
			end
			else
				update dbo.ttconstn set spool_qty_sb = (t.spool_qty_sb - 1),
										spool_qty_lb = (t.spool_qty_lb + 1)
					from dbo.ttconstn as t
					where t.PROGRESS_RECID = @ttconstn_lastid
					
			if (@painting_specs != '''')
			begin
				if ((@painting_primer_s != 0 and @painting_top_coat_s != 0) or
					(@painting_primer_s != 0 and @painting_top_coat_s = 0) or
					(@painting_primer_s = 0 and @painting_top_coat_s != 0))
				begin					
					delete from @action;
					merge dbo.ttpnt as target
					using (select @piping_class, @constn_area,
						(case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end),
						@sheet_no, @rev_no, @spool_no, @spool_no1, @painting_specs, @priority_no, @priority_timing, @constn_area, @unit_area, @painting_primer_s, @painting_top_coat_s, User, {fn NOW()}, convert(time,current_timestamp), ''Upload Piping MTO Data'') as src
						(piping_class, constn_area, pip_iso_no, sheet_no, rev_no, spool_no, spool_no1, painting_specs, priority_no, priority_timing, constn_unit, unit_area, painting_primer_s, painting_top_coat_s, loguser, logdate, logtime, logupdate)
					on (target.pip_iso_no = src.pip_iso_no and
						target.spool_no = src.spool_no)
					when matched then
						update set primer = (case when (src.painting_primer_s != 0) then src.painting_primer_s else target.primer end),
								   finishing = (case when (src.painting_top_coat_s != 0) then src.painting_top_coat_s else target.finishing end)
					when not matched then
						insert (piping_class, constn_area, pip_iso_no, sheet_no, rev_no, spool_no, spool_no1, painting_specs, priority_no, priority_timing, constn_unit, unit_area, primer, finishing, loguser, logdate, logtime, logupdate)
						values (src.piping_class, src.constn_area, src.pip_iso_no, src.sheet_no, src.rev_no, src.spool_no, src.spool_no1, src.painting_specs, src.priority_no, src.priority_timing, src.constn_area, src.unit_area, (case when (src.painting_primer_s != 0) then src.painting_primer_s else 0.00 end), (case when (src.painting_top_coat_s != 0) then src.painting_top_coat_s else 0.00 end), src.loguser, src.logdate, src.logtime, src.logupdate)
					output $action into @action;
					
					if (@painting_primer_s != 0)
						update dbo.ttconstn set paint_req_spl = (t.paint_req_spl - 1),
												paint_primer = (t.paint_primer + @painting_primer_s)
							from dbo.ttconstn as t
							where t.PROGRESS_RECID = @ttconstn_lastid
					if (@painting_top_coat_s != 0)
						update dbo.ttconstn set paint_finishing = (t.paint_finishing - @painting_top_coat_s)
							from dbo.ttconstn as t
							where t.PROGRESS_RECID = @ttconstn_lastid
						
					update dbo.ttconstn set paint_total_sa = (t.paint_total_sa - (@painting_primer_s + @painting_top_coat_s))
						from dbo.ttconstn as t
						where t.PROGRESS_RECID = @ttconstn_lastid
				end
			end
		end
		else
		begin
			insert into dbo.ttmatl_e
				select @pip_iso_no, @client_dwg_no, @constn_area, @lb_sb,
					@sheet_no, @rev_no, @line_no, @line_class, @material,
					@item_code, @spool_category, @spool_no, @size, @group_size,
					@qty, @item_no, @fitting_length, @total_length, @bolt_length,
					@group_1, @group_2, @mat_description, @painting_specs, @insul_type,
					@insul_thk, @insul_pipe_size, @insul_lm_untraced, @insul_lm_traced,
					@tp_no, @tp_type_of_test, @tp_f_s, @priority_timing, @priority_no,
					@piping_class, @total_sheets, @field_desc, @area_desc, @painting_primer_s,
					@painting_top_coat_s, USER, {fn NOW()}, CONVERT(time,current_timestamp),
					''Upload Piping MTO Data'', @file_origin, @spool_no1, @unit_area, @pip_iso_no1,
					'''', '''', '''', 0, 0
					
				update dbo.ttconstn set linear_field = (t.linear_field + @total_length)
					from dbo.ttconstn as t
					where t.PROGRESS_RECID = @ttconstn_lastid
							
				update dbo.ttiso set linear_field = (t.linear_field + @total_length)
					from dbo.ttiso as t
					where t.PROGRESS_RECID = @ttconstn_lastid
					
				if (@iso_lb_sb = ''LB'')		
					update dbo.ttconstn set linear_field_lb = (t.linear_field_lb + @total_length)
						from dbo.ttconstn as t
						where t.PROGRESS_RECID = @ttconstn_lastid
				if (@iso_lb_sb = ''SB'')		
					update dbo.ttconstn set linear_field_sb = (t.linear_field_sb + @total_length)
						from dbo.ttconstn as t
						where t.PROGRESS_RECID = @ttconstn_lastid
				
				update dbo.ttmngtsumm set total_lm_f = (t.total_lm_f + @total_length)
					from dbo.ttmngtsumm as t
					where t.PROGRESS_RECID = @ttmngtsumm_lastid
					
				if (@piping_class = ''A/G'')
					update dbo.ttmngtsumm_ag set total_lm_f = (t.total_lm_f + @total_length)
						from dbo.ttmngtsumm_ag as t
						where t.PROGRESS_RECID = @ttmngtsumm_ag_lastid
					
				if (@piping_class = ''U/G'')
					update dbo.ttmngtsumm_ug set total_lm_f = (t.total_lm_f + @total_length)
						from dbo.ttmngtsumm_ug as t
						where t.PROGRESS_RECID = @ttmngtsumm_ug_lastid
		end	
					
		update dbo.ttconstn set linear_total_lm = (t.linear_total_lm + @total_length)
			from dbo.ttconstn as t
			where t.PROGRESS_RECID = @ttconstn_lastid
					
		update dbo.ttiso set linear_total_lm = (t.linear_total_lm + @total_length)
			from dbo.ttiso as t
			where t.PROGRESS_RECID = @ttconstn_lastid
			
		if (@iso_lb_sb = ''LB'')		
			update dbo.ttconstn set linear_total_lm_lb = (t.linear_total_lm_lb + @total_length)
				from dbo.ttconstn as t
				where t.PROGRESS_RECID = @ttconstn_lastid
		if (@iso_lb_sb = ''SB'')		
			update dbo.ttconstn set linear_total_lm_sb = (t.linear_total_lm_sb + @total_length)
				from dbo.ttconstn as t
				where t.PROGRESS_RECID = @ttconstn_lastid
		
		update dbo.ttmngtsumm set total_lm = (t.total_lm + @total_length)
			from dbo.ttmngtsumm as t
			where t.PROGRESS_RECID = @ttmngtsumm_lastid
			
		if (@piping_class = ''A/G'')
			update dbo.ttmngtsumm_ag set total_lm = (t.total_lm + @total_length)
				from dbo.ttmngtsumm_ag as t
				where t.PROGRESS_RECID = @ttmngtsumm_ag_lastid
			
		if (@piping_class = ''U/G'')
			update dbo.ttmngtsumm_ug set total_lm = (t.total_lm + @total_length)
				from dbo.ttmngtsumm_ug as t
				where t.PROGRESS_RECID = @ttmngtsumm_ug_lastid
				
		fetch next from crs into @tp_no, @tp_type_of_test, @piping_class, @area_desc, @field_desc, @priority_timing, @priority_no, @unit_area, @constn_area, 
		@pip_iso_no, @sheet_no, @rev_no, @insul_lm_untraced, @insul_lm_traced, @iso_lb_sb, @pipmto_lb_sb, @spool_no, @client_dwg_no, @line_no, @line_class,
		@material, @item_code, @spool_category, @size, @group_size, @qty, @item_no, @fitting_length, @total_length, @bolt_length, @group_1, @group_2, 
		@mat_description, @painting_specs, @insul_type, @insul_thk, @insul_pipe_size, @tp_f_s, @total_sheets, @painting_primer_s, @painting_top_coat_s,
		@file_origin, @spool_no1, @pip_iso_no1
	end
	close crs
	deallocate crs
		   
	declare crs_tt2 cursor
		for select t5.piping_class, t5.priority_no, t5.priority_timing, t5.constn_area, t5.unit_area from dbo.ttiso t4 inner join (
		select t1.* from dbo.pip_mto_data t1 
			inner join (
				select t2.PROGRESS_RECID, RANK() over(partition by t2.piping_class, t2.constn_area, t2.pip_iso_no, t2.sheet_no, t2.rev_no order by t2.PROGRESS_RECID) as rankId 
				   from dbo.pip_mto_data as t2) t3 
				   on t3.PROGRESS_RECID = t1.PROGRESS_RECID and t3.rankId = 1) t5
		on t4.piping_class = t5.piping_class and
		   t4.constn_area = t5.constn_area and
		   t4.pip_iso_no = t5.pip_iso_no and
		   t4.sheet_no = t5.sheet_no and
		   t4.rev_no = t5.rev_no and
		   t4.insul_lm != 0
				
	open crs_tt2
	fetch next from crs_tt2 into @piping_class, @priority_no, @priority_timing, @constn_area, @unit_area
	while @@FETCH_STATUS = 0
	begin
		update t3 set insul_req_iso = (t3.insul_req_iso + 1)
			from (
				select *, rank() over(partition by t2.piping_class, t2.priority_no, t2.priority_timing, t2.constn_unit, t2.unit_area order by PROGRESS_RECID) as rankId
					from (select t1.* from dbo.ttconstn t1 where t1.piping_class = @piping_class and
								  t1.priority_no = @priority_no and
								  t1.priority_timing = @priority_timing and
								  t1.constn_unit = @constn_area and
								  t1.unit_area = @unit_area) t2) t3
					where t3.rankId = 1
					
		fetch next from crs_tt2 into @piping_class, @priority_no, @priority_timing, @constn_area, @unit_area
	end
	close crs_tt2
	deallocate crs_tt2

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[isoWQ2_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[isoWQ2_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[isoWQ2_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	begin transaction;
	
	-- proc_internal_clr
	delete from dbo.ttjnt_b;
	delete from dbo.ttjnt_t;
	delete from dbo.ttjnt_s;
	delete from dbo.ttjnt_w;
	delete from dbo.ttjnt_r;
	delete from dbo.tttie_in;
	update t set total_jnt_b = 0, total_jnt_t = 0, total_jnt_s = 0, total_jnt_w = 0, total_jnt_r = 0, total_jnt_b_dia = 0, total_jnt_t_dia = 0, total_jnt_s_dia = 0, total_jnt_w_dia = 0, total_jnt_r_dia = 0, total_jnt_b_dia_s = 0, total_jnt_t_dia_s = 0, total_jnt_s_dia_s = 0, total_jnt_w_dia_s = 0, total_jnt_r_dia_s = 0, total_jnt_b_dia_f = 0, total_jnt_t_dia_f = 0, total_jnt_s_dia_f = 0, total_jnt_w_dia_f = 0, total_jnt_r_dia_f = 0, total_jnt_b_dia_t = 0, total_jnt_t_dia_t = 0, total_jnt_s_dia_t = 0, total_jnt_w_dia_t = 0, total_jnt_r_dia_t = 0, total_tip = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
		where t.Rn = 1
	update t set total_jnt_b = 0, total_jnt_t = 0, total_jnt_s = 0, total_jnt_w = 0, total_jnt_r = 0, total_jnt_b_dia = 0, total_jnt_t_dia = 0, total_jnt_s_dia = 0, total_jnt_w_dia = 0, total_jnt_r_dia = 0, total_jnt_b_dia_s = 0, total_jnt_t_dia_s = 0, total_jnt_s_dia_s = 0, total_jnt_w_dia_s = 0, total_jnt_r_dia_s = 0, total_jnt_b_dia_f = 0, total_jnt_t_dia_f = 0, total_jnt_s_dia_f = 0, total_jnt_w_dia_f = 0, total_jnt_r_dia_f = 0, total_jnt_b_dia_t = 0, total_jnt_t_dia_t = 0, total_jnt_s_dia_t = 0, total_jnt_w_dia_t = 0, total_jnt_r_dia_t = 0, total_tip = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
		where t.Rn = 1
	update t set total_jnt_b = 0, total_jnt_t = 0, total_jnt_s = 0, total_jnt_w = 0, total_jnt_r = 0, total_jnt_b_dia = 0, total_jnt_t_dia = 0, total_jnt_s_dia = 0, total_jnt_w_dia = 0, total_jnt_r_dia = 0, total_jnt_b_dia_s = 0, total_jnt_t_dia_s = 0, total_jnt_s_dia_s = 0, total_jnt_w_dia_s = 0, total_jnt_r_dia_s = 0, total_jnt_b_dia_f = 0, total_jnt_t_dia_f = 0, total_jnt_s_dia_f = 0, total_jnt_w_dia_f = 0, total_jnt_r_dia_f = 0, total_jnt_b_dia_t = 0, total_jnt_t_dia_t = 0, total_jnt_s_dia_t = 0, total_jnt_w_dia_t = 0, total_jnt_r_dia_t = 0, total_tip = 0
		from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
		where t.Rn = 1

	declare @pip_iso_no varchar(max)
	declare @client_dwg_no varchar(max)
	declare @tie_in_joints varchar(max)
	declare @lb_sb varchar(max)
	declare @sheet_no varchar(max)
	declare @total_sheets varchar(max)
	declare @rev_no varchar(max)
	declare @line_no varchar(max)
	declare @constn_area varchar(max)
	declare @line_class varchar(max)
	declare @material varchar(max)
	declare @joint_category varchar(max)
	declare @spool_no varchar(max)
	declare @joint_no varchar(max)
	declare @size varchar(max)
	declare @bolt_up_support varchar(max)
	declare @schedule varchar(max)
	declare @joint_type varchar(max)
	declare @weld_location varchar(max)
	declare @tp_no varchar(max)
	declare @tp_type_of_test varchar(max)
	declare @tp_f_s varchar(max)
	declare @priority_timing varchar(max)
	declare @priority_no varchar(max)	
	declare @piping_class varchar(max)
	declare @field_desc varchar(max)
	declare @area_desc varchar(max)
	declare @logupdate varchar(max)
	declare @unit_area varchar(max)
	declare @file_origin varchar(max)
	declare crs cursor read_only
		for select pip_iso_no, client_dwg_no, tie_in_joints, lb_sb, sheet_no, total_sheets, rev_no, line_no, constn_area, line_class, material, joint_category,
				spool_no, joint_no, size, bolt_up_support, schedule, joint_type, weld_location, tp_no, tp_type_of_test, tp_f_s, priority_timing, priority_no,
				piping_class, field_desc, area_desc, logupdate, unit_area, file_origin from dbo.pip_weld_data;
				
	open crs
	fetch next from crs into @pip_iso_no, @client_dwg_no, @tie_in_joints, @lb_sb, @sheet_no, @total_sheets, @rev_no, @line_no, @constn_area, @line_class, @material, @joint_category,
				@spool_no, @joint_no, @size, @bolt_up_support, @schedule, @joint_type, @weld_location, @tp_no, @tp_type_of_test, @tp_f_s, @priority_timing, @priority_no,
				@piping_class, @field_desc, @area_desc, @logupdate, @unit_area, @file_origin
	while @@FETCH_STATUS = 0
	begin
		-- proc_internal_tbl1
		if (@joint_type = ''FC'')
		begin
			insert into dbo.ttjnt_b
				select @pip_iso_no, @client_dwg_no, @tie_in_joints, @lb_sb, @sheet_no, @total_sheets, @rev_no, @line_no, @constn_area, @line_class, @material, @joint_category,
					@spool_no, @joint_no, @size, @bolt_up_support, @schedule, @joint_type, @weld_location, @tp_no, @tp_type_of_test, @tp_f_s, @priority_timing, @priority_no,
					@piping_class, @field_desc, @area_desc, USER, {fn NOW()}, CONVERT(time, current_timestamp), @logupdate, @file_origin,0;
								
			update t set total_jnt_b = (total_jnt_b + 1)
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
				where t.Rn = 1
							
			if (@piping_class = ''A/G'')
				update t set total_jnt_b = (total_jnt_b + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
					where t.Rn = 1
							
			if (@piping_class = ''U/G'')
				update t set total_jnt_b = (total_jnt_b + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
					where t.Rn = 1
					
			if (@bolt_up_support != '''' and charindex(''DEL'',@bolt_up_support,1) != 1 and dbo.num_entries_fn(@bolt_up_support,''/'') = 1)
			begin
				if (charindex(''F'',@weld_location,1) = 1)
				begin
					update t set total_jnt_b_dia_f = (total_jnt_b_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_b_dia_f = (total_jnt_b_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_b_dia_f = (total_jnt_b_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				if (charindex(''S'',@weld_location,1) = 1)
				begin
					update t set total_jnt_b_dia_s = (total_jnt_b_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_b_dia_s = (total_jnt_b_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_b_dia_s = (total_jnt_b_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				if (charindex(''T'',@weld_location,1) = 1)
				begin
					update t set total_jnt_b_dia_t = (total_jnt_b_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_b_dia_t = (total_jnt_b_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_b_dia_t = (total_jnt_b_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				update t set total_jnt_b_dia = (total_jnt_b_dia + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
					where t.Rn = 1
								
				if (@piping_class = ''A/G'')
					update t set total_jnt_b_dia = (total_jnt_b_dia + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
						where t.Rn = 1
								
				if (@piping_class = ''U/G'')
					update t set total_jnt_b_dia = (total_jnt_b_dia + convert(decimal(17,2),LTRIM(RTRIM(@bolt_up_support))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
						where t.Rn = 1
			end
		end	
		else if (@joint_type = ''T'')
		begin
			insert into dbo.ttjnt_t
				select @pip_iso_no, @client_dwg_no, @tie_in_joints, @lb_sb, @sheet_no, @total_sheets, @rev_no, @line_no, @constn_area, @line_class, @material, @joint_category,
					@spool_no, @joint_no, @size, @bolt_up_support, @schedule, @joint_type, @weld_location, @tp_no, @tp_type_of_test, @tp_f_s, @priority_timing, @priority_no,
					@piping_class, @field_desc, @area_desc, @unit_area, USER, {fn NOW()}, convert(varchar(max),CONVERT(time, current_timestamp)), @logupdate, 0;
								
			update t set total_jnt_t = (total_jnt_t + 1)
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
				where t.Rn = 1
							
			if (@piping_class = ''A/G'')
				update t set total_jnt_t = (total_jnt_t + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
					where t.Rn = 1
							
			if (@piping_class = ''U/G'')
				update t set total_jnt_t = (total_jnt_t + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
					where t.Rn = 1
					
			if (@size != '''' and charindex(''DEL'',@size,1) != 1 and dbo.num_entries_fn(@size,''/'') = 1)
			begin
				if (charindex(''F'',@weld_location,1) = 1)
				begin
					update t set total_jnt_t_dia_f = (total_jnt_t_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_t_dia_f = (total_jnt_t_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_t_dia_f = (total_jnt_t_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				if (charindex(''S'',@weld_location,1) = 1)
				begin
					update t set total_jnt_t_dia_s = (total_jnt_t_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_t_dia_s = (total_jnt_t_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_t_dia_s = (total_jnt_t_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				if (charindex(''T'',@weld_location,1) = 1)
				begin
					update t set total_jnt_t_dia_t = (total_jnt_t_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_t_dia_t = (total_jnt_t_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_t_dia_t = (total_jnt_t_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				update t set total_jnt_t_dia = (total_jnt_t_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
					where t.Rn = 1
								
				if (@piping_class = ''A/G'')
					update t set total_jnt_t_dia = (total_jnt_t_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
						where t.Rn = 1
								
				if (@piping_class = ''U/G'')
					update t set total_jnt_t_dia = (total_jnt_t_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
						where t.Rn = 1
			end
		end	
		else if (@joint_type = ''S'')
		begin
			insert into dbo.ttjnt_s
				select @pip_iso_no, @client_dwg_no, @tie_in_joints, @lb_sb, @sheet_no, @total_sheets, @rev_no, @line_no, @constn_area, @line_class, @material, @joint_category,
					@spool_no, @joint_no, @size, @bolt_up_support, @schedule, @joint_type, @weld_location, @tp_no, @tp_type_of_test, @tp_f_s, @priority_timing, @priority_no,
					@piping_class, @field_desc, @area_desc, @unit_area, USER, {fn NOW()}, convert(varchar(max),CONVERT(time, current_timestamp)), @logupdate, 0;
								
			update t set total_jnt_s = (total_jnt_s + 1)
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
				where t.Rn = 1
							
			if (@piping_class = ''A/G'')
				update t set total_jnt_s = (total_jnt_s + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
					where t.Rn = 1
							
			if (@piping_class = ''U/G'')
				update t set total_jnt_s = (total_jnt_s + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
					where t.Rn = 1
					
			if (@size != '''' and charindex(''DEL'',@size,1) != 1 and dbo.num_entries_fn(@size,''/'') = 1)
			begin
				if (charindex(''F'',@weld_location,1) = 1)
				begin
					update t set total_jnt_s_dia_f = (total_jnt_s_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_s_dia_f = (total_jnt_s_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_s_dia_f = (total_jnt_s_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				if (charindex(''S'',@weld_location,1) = 1)
				begin
					update t set total_jnt_s_dia_s = (total_jnt_s_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_s_dia_s = (total_jnt_s_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_s_dia_s = (total_jnt_s_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				if (charindex(''T'',@weld_location,1) = 1)
				begin
					update t set total_jnt_s_dia_t = (total_jnt_s_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_s_dia_t = (total_jnt_s_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_s_dia_t = (total_jnt_s_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				update t set total_jnt_s_dia = (total_jnt_s_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
					where t.Rn = 1
								
				if (@piping_class = ''A/G'')
					update t set total_jnt_s_dia = (total_jnt_s_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
						where t.Rn = 1
								
				if (@piping_class = ''U/G'')
					update t set total_jnt_s_dia = (total_jnt_s_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
						where t.Rn = 1
			end
		end	
		else if (@joint_type = ''RTR'')
		begin
			insert into dbo.ttjnt_r
				select @pip_iso_no, @client_dwg_no, @tie_in_joints, @lb_sb, @sheet_no, @total_sheets, @rev_no, @line_no, @constn_area, @line_class, @material, @joint_category,
					@spool_no, @joint_no, @size, @bolt_up_support, @schedule, @joint_type, @weld_location, @tp_no, @tp_type_of_test, @tp_f_s, @priority_timing, @priority_no,
					@piping_class, @field_desc, @area_desc, @unit_area, USER, {fn NOW()}, convert(varchar(max),CONVERT(time, current_timestamp)), @logupdate, 0;
								
			update t set total_jnt_r = (total_jnt_r + 1)
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
				where t.Rn = 1
							
			if (@piping_class = ''A/G'')
				update t set total_jnt_r = (total_jnt_r + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
					where t.Rn = 1
							
			if (@piping_class = ''U/G'')
				update t set total_jnt_r = (total_jnt_r + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
					where t.Rn = 1
					
			if (@size != '''' and charindex(''DEL'',@size,1) != 1 and dbo.num_entries_fn(@size,''/'') = 1)
			begin
				if (charindex(''F'',@weld_location,1) = 1)
				begin
					update t set total_jnt_r_dia_f = (total_jnt_r_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_r_dia_f = (total_jnt_r_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_r_dia_f = (total_jnt_r_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				if (charindex(''S'',@weld_location,1) = 1)
				begin
					update t set total_jnt_r_dia_s = (total_jnt_r_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_r_dia_s = (total_jnt_r_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_r_dia_s = (total_jnt_r_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				if (charindex(''T'',@weld_location,1) = 1)
				begin
					update t set total_jnt_r_dia_t = (total_jnt_r_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_r_dia_t = (total_jnt_r_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_r_dia_t = (total_jnt_r_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				update t set total_jnt_r_dia = (total_jnt_r_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
					where t.Rn = 1
								
				if (@piping_class = ''A/G'')
					update t set total_jnt_r_dia = (total_jnt_r_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
						where t.Rn = 1
								
				if (@piping_class = ''U/G'')
					update t set total_jnt_r_dia = (total_jnt_r_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
						where t.Rn = 1
			end
		end	
		else 
		begin
			insert into dbo.ttjnt_w
				select @pip_iso_no, @client_dwg_no, @tie_in_joints, @lb_sb, @sheet_no, @total_sheets, @rev_no, @line_no, @constn_area, @line_class, @material, @joint_category,
					@spool_no, @joint_no, @size, @bolt_up_support, @schedule, @joint_type, @weld_location, @tp_no, @tp_type_of_test, @tp_f_s, @priority_timing, @priority_no,
					@piping_class, @field_desc, @area_desc, USER, {fn NOW()}, convert(varchar(max),CONVERT(time, current_timestamp)), @logupdate, @file_origin, 0;
								
			update t set total_jnt_w = (total_jnt_w + 1)
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
				where t.Rn = 1
							
			if (@piping_class = ''A/G'')
				update t set total_jnt_w = (total_jnt_w + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
					where t.Rn = 1
							
			if (@piping_class = ''U/G'')
				update t set total_jnt_w = (total_jnt_w + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
					where t.Rn = 1
					
			if (@size != '''' and charindex(''DEL'',@size,1) != 1 and dbo.num_entries_fn(@size,''/'') = 1)
			begin
				if (charindex(''F'',@weld_location,1) = 1)
				begin
					update t set total_jnt_w_dia_f = (total_jnt_w_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_w_dia_f = (total_jnt_w_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_w_dia_f = (total_jnt_w_dia_f + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				if (charindex(''S'',@weld_location,1) = 1)
				begin
					update t set total_jnt_w_dia_s = (total_jnt_w_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_w_dia_s = (total_jnt_w_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_w_dia_s = (total_jnt_w_dia_s + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				if (charindex(''T'',@weld_location,1) = 1)
				begin
					update t set total_jnt_w_dia_t = (total_jnt_w_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
						where t.Rn = 1
									
					if (@piping_class = ''A/G'')
						update t set total_jnt_w_dia_t = (total_jnt_w_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
							where t.Rn = 1
									
					if (@piping_class = ''U/G'')
						update t set total_jnt_w_dia_t = (total_jnt_w_dia_t + convert(decimal(17,2),LTRIM(RTRIM(@size))))
							from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
							where t.Rn = 1
				end
				update t set total_jnt_w_dia = (total_jnt_w_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
					where t.Rn = 1
								
				if (@piping_class = ''A/G'')
					update t set total_jnt_w_dia = (total_jnt_w_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
						where t.Rn = 1
								
				if (@piping_class = ''U/G'')
					update t set total_jnt_w_dia = (total_jnt_w_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
						from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
						where t.Rn = 1
			end
		end	
		
		if (@tie_in_joints != '''')
		begin
			insert into dbo.tttie_in
				select @pip_iso_no, @client_dwg_no, @tie_in_joints, @lb_sb, @sheet_no, @total_sheets, @rev_no, @line_no, @constn_area, @line_class, @material, @joint_category,
					@spool_no, @joint_no, @size, @bolt_up_support, @schedule, @joint_type, @weld_location, @tp_no, @tp_type_of_test, @tp_f_s, @priority_timing, @priority_no,
					@piping_class, @field_desc, @area_desc, USER, {fn NOW()}, convert(varchar(max),CONVERT(time, current_timestamp)), @logupdate, @file_origin, 0;
								
			update t set total_tip = (total_tip + 1)
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm tp) t
				where t.Rn = 1
							
			if (@piping_class = ''A/G'')
				update t set total_tip = (total_tip + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ag tp) t
					where t.Rn = 1
							
			if (@piping_class = ''U/G'')
				update t set total_tip = (total_tip + 1)
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttmngtsumm_ug tp) t
					where t.Rn = 1
		end
		
		fetch next from crs into @pip_iso_no, @client_dwg_no, @tie_in_joints, @lb_sb, @sheet_no, @total_sheets, @rev_no, @line_no, @constn_area, @line_class, @material, @joint_category,
					@spool_no, @joint_no, @size, @bolt_up_support, @schedule, @joint_type, @weld_location, @tp_no, @tp_type_of_test, @tp_f_s, @priority_timing, @priority_no,
					@piping_class, @field_desc, @area_desc, @logupdate, @unit_area, @file_origin
	end
	close crs
	deallocate crs
    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[isoWQ1_sp]    Script Date: 03/18/2015 14:16:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[isoWQ1_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[isoWQ1_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;

	--proc_internal_clr
	update dbo.ttConstn set weld_field = 0, weld_shop = 0, weld_threaded = 0, weld_total_dia = 0, weld_field_lb = 0, weld_shop_lb = 0, weld_threaded_lb = 0, weld_total_dia_lb = 0, weld_field_sb = 0, weld_shop_sb = 0, weld_threaded_sb = 0, weld_total_dia_sb = 0;
	update dbo.tttestpack set weld_field = 0, weld_shop = 0, weld_threaded = 0, weld_total_dia = 0;
	update dbo.ttiso set weld_field = 0, weld_shop = 0, weld_threaded = 0, weld_total_dia = 0;
	update dbo.ttspl set weld_field = 0, weld_shop = 0, weld_threaded = 0, weld_total_dia = 0;
	update dbo.tttp set weld_field = 0, weld_shop = 0, weld_threaded = 0, weld_total_dia = 0;
	update dbo.tttpiso set weld_field = 0, weld_shop = 0, weld_threaded = 0, weld_total_dia = 0;
	update dbo.tttpspl set weld_field = 0, weld_shop = 0, weld_threaded = 0, weld_total_dia = 0;

	declare @piping_class varchar(max)
	declare @priority_no varchar(max)
	declare @priority_timing varchar(max)
	declare @field_desc varchar(max)
	declare @area_desc varchar(max)
	declare @constn_area varchar(max)
	declare @unit_area varchar(max)
	declare @size varchar(max)
	declare @weld_location varchar(max)
	declare @lb_sb varchar(max)
	declare @pip_iso_no varchar(max)
	declare @sheet_no varchar(max)
	declare @rev_no varchar(max)
	declare @spool_no varchar(max)
	declare @tp_no varchar(max)
	declare @tp_type_of_test varchar(max)
	declare crs cursor read_only
		for select piping_class, priority_no, priority_timing, field_desc, area_desc,
				constn_area, unit_area, size, weld_location, lb_sb, pip_iso_no, sheet_no, 
				rev_no, spool_no, tp_no, tp_type_of_test from dbo.pip_weld_data
				
	open crs
	fetch next from crs into @piping_class, @priority_no, @priority_timing, @field_desc, @area_desc, @constn_area, @unit_area, @size, @weld_location, @lb_sb, @pip_iso_no, @sheet_no, @rev_no, @spool_no, @tp_no, @tp_type_of_test
	while @@FETCH_STATUS = 0
	begin
		if (@piping_class != '''')
			merge ttpc as target
			using (select @piping_class) as src (piping_class)
			on (target.piping_class = src.piping_class)
			when not matched then
				insert (piping_class, datasource, loguser, logdate, logtime, logupdate)
				values(src.piping_class, ''pip_weld_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Weld/Joint Data'');
				
		if (@priority_no != '''')
			merge ttpn as target
			using (select @priority_no) as src (priority_no)
			on (target.priority_no = src.priority_no)
			when not matched then
				insert (priority_no, datasource, loguser, logdate, logtime, logupdate)
				values(src.priority_no, ''pip_weld_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Weld/Joint Data'');
				
		if (@priority_timing != '''')
			merge ttpt as target
			using (select @priority_timing) as src (priority_timing)
			on (target.priority_timing = src.priority_timing)
			when not matched then
				insert (priority_timing, datasource, loguser, logdate, logtime, logupdate)
				values(src.priority_timing, ''pip_weld_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Weld/Joint Data'');
				
		if (@field_desc != '''')
			merge ttfd as target
			using (select @field_desc) as src (field_desc)
			on (target.field_desc = src.field_desc)
			when not matched then
				insert (field_desc, datasource, loguser, logdate, logtime, logupdate)
				values(src.field_desc, ''pip_weld_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Weld/Joint Data'');
				
		if (@area_desc != '''')
			merge ttad as target
			using (select @area_desc) as src (area_desc)
			on (target.area_desc = src.area_desc)
			when not matched then
				insert (area_desc, datasource, loguser, logdate, logtime, logupdate)
				values(src.area_desc, ''pip_weld_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Weld/Joint Data'');
				
		merge ttconstn as target
		using (select @piping_class, @priority_no, @priority_timing, @constn_area, @unit_area) as src (piping_class, priority_no, priority_timing, constn_area, unit_area)
		on (target.piping_class = src.piping_class and
			target.priority_no = src.priority_no and
			target.priority_timing = src.priority_timing and
			target.constn_unit = src.constn_area and
			target.unit_area = src.unit_area)
		when not matched then
			insert (piping_class, priority_no, priority_timing, constn_unit, unit_area, datasource, loguser, logdate, logtime, logupdate)
			values(src.piping_class, src.priority_no, src.priority_timing, src.constn_area, src.unit_area, ''pip_weld_data'', user, {fn NOW()}, convert(time, current_timestamp), ''Upload Piping Weld/Joint Data'');
			
		if (@size != '''' and charindex(''DEL'',@size,1) != 1 and dbo.num_entries_fn(@size,''/'') = 1)
		begin
			if (charindex(''F'',@weld_location,1) = 1)
			begin
				update t set weld_field = (t.weld_field + convert(decimal(17,2),LTRIM(RTRIM(@size)))),
							 weld_field_lb = (case when (@lb_sb = ''LB'') then (weld_field_lb + convert(decimal(17,2),LTRIM(RTRIM(@size)))) else (weld_field_lb) end),
							 weld_field_sb = (case when (@lb_sb = ''SB'') then (weld_field_sb + convert(decimal(17,2),LTRIM(RTRIM(@size)))) else (weld_field_sb) end)
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttconstn tp where tp.piping_class = @piping_class and tp.priority_no = @priority_no and tp.priority_timing = @priority_timing and tp.constn_unit = @constn_area) t
				where t.Rn = 1
				
				update t set weld_field = (t.weld_field + convert(decimal(17,2),LTRIM(RTRIM(@size))))
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttiso tp where tp.piping_class = @piping_class and tp.priority_no = @priority_no and tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.sheet_no = @sheet_no and tp.rev_no = @rev_no) t
				where t.Rn = 1
				
				update t set weld_field = (t.weld_field + convert(decimal(17,2),LTRIM(RTRIM(@size))))
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttspl tp where tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.spool_no = @spool_no) t
				where t.Rn = 1
			end
			if (charindex(''S'',@weld_location,1) = 1)
			begin
				update t set weld_shop = (t.weld_shop + convert(decimal(17,2),LTRIM(RTRIM(@size)))),
							 weld_shop_lb = (case when (@lb_sb = ''LB'') then (weld_shop_lb + convert(decimal(17,2),LTRIM(RTRIM(@size)))) else (weld_shop_lb) end),
							 weld_shop_sb = (case when (@lb_sb = ''SB'') then (weld_shop_sb + convert(decimal(17,2),LTRIM(RTRIM(@size)))) else (weld_shop_sb) end)
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttconstn tp where tp.piping_class = @piping_class and tp.priority_no = @priority_no and tp.priority_timing = @priority_timing and tp.constn_unit = @constn_area) t
				where t.Rn = 1
				
				update t set weld_shop = (t.weld_shop + convert(decimal(17,2),LTRIM(RTRIM(@size))))
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttiso tp where tp.piping_class = @piping_class and tp.priority_no = @priority_no and tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.sheet_no = @sheet_no and tp.rev_no = @rev_no) t
				where t.Rn = 1
				
				update t set weld_shop = (t.weld_shop + convert(decimal(17,2),LTRIM(RTRIM(@size))))
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttspl tp where tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.spool_no = @spool_no) t
				where t.Rn = 1
			end
			if (charindex(''T'',@weld_location,1) = 1)
			begin
				update t set weld_threaded = (t.weld_threaded + convert(decimal(17,2),LTRIM(RTRIM(@size)))),
							 weld_threaded_lb = (case when (@lb_sb = ''LB'') then (weld_threaded_lb + convert(decimal(17,2),LTRIM(RTRIM(@size)))) else (weld_threaded_lb) end),
							 weld_threaded_sb = (case when (@lb_sb = ''SB'') then (weld_threaded_sb + convert(decimal(17,2),LTRIM(RTRIM(@size)))) else (weld_threaded_sb) end)
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttconstn tp where tp.piping_class = @piping_class and tp.priority_no = @priority_no and tp.priority_timing = @priority_timing and tp.constn_unit = @constn_area) t
				where t.Rn = 1
				
				update t set weld_threaded = (t.weld_threaded + convert(decimal(17,2),LTRIM(RTRIM(@size))))
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttiso tp where tp.piping_class = @piping_class and tp.priority_no = @priority_no and tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.sheet_no = @sheet_no and tp.rev_no = @rev_no) t
				where t.Rn = 1
				
				update t set weld_threaded = (t.weld_threaded + convert(decimal(17,2),LTRIM(RTRIM(@size))))
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttspl tp where tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.spool_no = @spool_no) t
				where t.Rn = 1
			end
			
			update t set weld_total_dia = (t.weld_total_dia + convert(decimal(17,2),LTRIM(RTRIM(@size)))),
						 weld_total_dia_lb = (case when (@lb_sb = ''LB'') then (weld_total_dia_lb + convert(decimal(17,2),LTRIM(RTRIM(@size)))) else (weld_total_dia_lb) end),
						 weld_total_dia_sb = (case when (@lb_sb = ''SB'') then (weld_total_dia_sb + convert(decimal(17,2),LTRIM(RTRIM(@size)))) else (weld_total_dia_sb) end)
			from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttconstn tp where tp.piping_class = @piping_class and tp.priority_no = @priority_no and tp.priority_timing = @priority_timing and tp.constn_unit = @constn_area) t
			where t.Rn = 1
			
			update t set weld_total_dia = (t.weld_total_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
			from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttiso tp where tp.piping_class = @piping_class and tp.priority_no = @priority_no and tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.sheet_no = @sheet_no and tp.rev_no = @rev_no) t
			where t.Rn = 1
			
			update t set weld_total_dia = (t.weld_total_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
			from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.ttspl tp where tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.spool_no = @spool_no) t
			where t.Rn = 1
		end
		
		if (@tp_no != '''')
		begin
			if (@size != '''' and charindex(''DEL'',@size,1) != 1 and dbo.num_entries_fn(@size,''/'') = 1)
			begin
				if (charindex(''F'',@weld_location,1) = 1)
				begin
					update t set weld_field = (t.weld_field + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no) t
					where t.Rn = 1
					
					update t set weld_field = (t.weld_field + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttp tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no and tp.tp_type_of_test = @tp_type_of_test) t
					where t.Rn = 1
					
					update t set weld_field = (t.weld_field + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttpiso tp where tp.piping_class = @piping_class and tp.constn_area = @constn_area and tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.sheet_no = @sheet_no and tp.rev_no = @rev_no and tp.tp_no = @tp_no) t
					where t.Rn = 1
					
					update t set weld_field = (t.weld_field + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttpspl tp where tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.spool_no = @spool_no and tp.tp_no = @tp_no) t
					where t.Rn = 1
				end
				if (charindex(''S'',@weld_location,1) = 1)
				begin
					update t set weld_shop = (t.weld_shop + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no) t
					where t.Rn = 1
					
					update t set weld_shop = (t.weld_shop + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttp tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no and tp.tp_type_of_test = @tp_type_of_test) t
					where t.Rn = 1
					
					update t set weld_shop = (t.weld_shop + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttpiso tp where tp.piping_class = @piping_class and tp.constn_area = @constn_area and tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.sheet_no = @sheet_no and tp.rev_no = @rev_no and tp.tp_no = @tp_no) t
					where t.Rn = 1
					
					update t set weld_shop = (t.weld_shop + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttpspl tp where tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.spool_no = @spool_no and tp.tp_no = @tp_no) t
					where t.Rn = 1
				end
				if (charindex(''T'',@weld_location,1) = 1)
				begin
					update t set weld_threaded = (t.weld_threaded + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no) t
					where t.Rn = 1
					
					update t set weld_threaded = (t.weld_threaded + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttp tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no and tp.tp_type_of_test = @tp_type_of_test) t
					where t.Rn = 1
					
					update t set weld_threaded = (t.weld_threaded + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttpiso tp where tp.piping_class = @piping_class and tp.constn_area = @constn_area and tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.sheet_no = @sheet_no and tp.rev_no = @rev_no and tp.tp_no = @tp_no) t
					where t.Rn = 1
					
					update t set weld_threaded = (t.weld_threaded + convert(decimal(17,2),LTRIM(RTRIM(@size))))
					from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttpspl tp where tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.spool_no = @spool_no and tp.tp_no = @tp_no) t
					where t.Rn = 1
				end				
				
				update t set weld_total_dia = (t.weld_total_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttestpack tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no) t
				where t.Rn = 1
				
				update t set weld_total_dia = (t.weld_total_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttp tp where tp.piping_class = @piping_class and tp.tp_no = @tp_no and tp.tp_type_of_test = @tp_type_of_test) t
				where t.Rn = 1
				
				update t set weld_total_dia = (t.weld_total_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttpiso tp where tp.piping_class = @piping_class and tp.constn_area = @constn_area and tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.sheet_no = @sheet_no and tp.rev_no = @rev_no and tp.tp_no = @tp_no) t
				where t.Rn = 1
				
				update t set weld_total_dia = (t.weld_total_dia + convert(decimal(17,2),LTRIM(RTRIM(@size))))
				from (select *, ROW_NUMBER() OVER(ORDER BY PROGRESS_RECID) As Rn from dbo.tttpspl tp where tp.pip_iso_no = (case when (@piping_class = ''A/G'') then @pip_iso_no else (case when (@piping_class = ''U/G'') then (@pip_iso_no + ''-'' + (case when (len(@sheet_no) = 1) then (''0'' + @sheet_no) else @sheet_no end)) else '''' end) end) and tp.spool_no = @spool_no and tp.tp_no = @tp_no) t
				where t.Rn = 1
			end
		end
	
		fetch next from crs into @piping_class, @priority_no, @priority_timing, @field_desc, @area_desc, @constn_area, @unit_area, @size, @weld_location, @lb_sb, @pip_iso_no, @sheet_no, @rev_no, @spool_no, @tp_no, @tp_type_of_test
	end
	close crs
	deallocate crs

    -- Insert statements for procedure here
	-- SELECT <@Param1, sysname, @p1>, <@Param2, sysname, @p2>

    --Checking for any error in the whole transaction (all 3 table insert operation)
    IF @@ERROR > 0
        --rollback if there was any error
        --ROLLBACK TRANSACTION
        goto _FAIL
    ELSE
        --commit whole transaction
        --COMMIT TRANSACTION
        goto _SUCCESS
        
    _ERROR:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _FAIL:    
        ROLLBACK TRANSACTION
		--set @result = @@ERROR;
		return @@ERROR
		
    _SUCCESS:    
        COMMIT TRANSACTION
		--set @result = 1;
		return 1
	SET NOCOUNT ON;
END
' 
END
GO
