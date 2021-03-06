USE [tempdb_sql]
GO
/****** Object:  StoredProcedure [dbo].[proc_excess_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[proc_excess_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[proc_excess_sp]
	-- Add the parameters for the stored procedure here
	@nsuserid as varchar(max)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
    -- Insert statements for procedure here
	begin transaction;
		
	declare @stock_no varchar(max)
	declare @item_code varchar(max)
	declare @commodity_code varchar(max)
	declare @iss_qty decimal	
	declare @req_qty decimal
	declare @old_iss decimal	
	declare @old_req decimal		
	declare @dcExcess decimal
	declare crs cursor read_only
		for select stock_no, item_code, commodity_code, iss_qty, old_iss,
		req_qty, old_req from dbo.ttemp_conf where excess = 0

    -- Insert statements for procedure here			
	open crs
	fetch next from crs into @stock_no, @item_code, @commodity_code, @iss_qty, @old_iss,
		@req_qty, @old_req
	while @@FETCH_STATUS = 0
	begin
		if (@iss_qty > @req_qty)
			set @dcExcess = (case when @old_iss = 0 or @old_req > @old_iss then (@iss_qty - @req_qty) else ((@iss_qty - @old_iss) - (@req_qty - @old_req)) end)
		else
			set @dcExcess = (@old_iss - @old_req)
	
		merge piping.dbo.mat_excess as target
		using (select @stock_no, @item_code, @commodity_code) as src
			  (stock_no, item_code, commodity_code)
		on (target.commodity_code = src.commodity_code and
			target.stock_no = @stock_no and
			target.item_code = @item_code
		   )
		when matched then
			update set target.tot_qty = target.tot_qty + @dcExcess,
					   target.onhand_qty = target.onhand_qty + @dcExcess,
					   target.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))
		when not matched then
			insert (stock_no, item_code, commodity_code, log_user, log_date, log_time, tot_qty, onhand_qty, log_update)
			values (src.stock_no, src.item_code, src.commodity_code, @nsuserid, {fn NOW()}, convert(time,CURRENT_TIMESTAMP),@dcExcess,@dcExcess,UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP)));
						
		fetch next from crs into @stock_no, @item_code, @commodity_code, @iss_qty, @old_iss,
			@req_qty, @old_req
	end
	close crs
	deallocate crs
    
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
/****** Object:  StoredProcedure [dbo].[proc_ex_compute_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[proc_ex_compute_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[proc_ex_compute_sp]
	-- Add the parameters for the stored procedure here
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
    -- Insert statements for procedure here
	begin transaction;

	update t2
		set t2.onhand_qty = (case when t3.excess = 1 or (t3.excess = 1 and t3.old_ex = 1) then t2.onhand_qty - t3.dcExcess else t2.onhand_qty end),
			t2.iss_qty = (case when t3.excess = 1 or (t3.excess = 1 and t3.old_ex = 1) then t2.iss_qty + t3.dcExcess else t2.iss_qty end)
		from piping.dbo.mat_excess t2
		inner join (
			select (case when t.excess = 1 and t.old_ex = 1 then (t.iss_qty - t.old_iss)
						 when t.excess = 1 and t.old_ex = 0 then t.iss_qty
						 when t.excess = 0 and t.old_ex = 1 then t.old_iss
						 else 0 end) as dcExcess, t.excess, t.old_ex, t.stock_no, t.item_code,
						 t.commodity_code
				from dbo.ttemp_conf t
		) t3
		on t2.stock_no = t3.stock_no and
		   t2.item_code = t3.item_code and
		   t2.commodity_code = t3.commodity_code
    
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
/****** Object:  StoredProcedure [dbo].[proc_compute_1_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[proc_compute_1_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[proc_compute_1_sp]
	@disc_code as varchar(max)
	-- Add the parameters for the stored procedure here
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	begin transaction;	
		
	declare @jmif_no varchar(max)
	declare @stock_no varchar(max)	
	declare @item_code varchar(max)
	declare @commodity_code varchar(max)
	declare @size varchar(max)
	declare @plant_no varchar(max)
	declare @area_no varchar(max)
	declare @drawing_no varchar(max)
	declare @sheet_no varchar(max)
	declare @rev_no varchar(max)
	declare @spool_no varchar(max)
	
	--declare @excess tinyint	
	--declare @old_req decimal
	declare crs_comp cursor read_only
		for select jmif_no, stock_no, item_code, commodity_code, size, plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no from dbo.ttemp_conf

    -- Insert statements for procedure here			
	open crs_comp
	fetch next from crs_comp into @jmif_no, @stock_no, @item_code, @commodity_code, @size, @plant_no, @area_no, @drawing_no, @sheet_no, @rev_no, @spool_no
	while @@FETCH_STATUS = 0
	begin	
				  
		if @disc_code = ''pip'' or @disc_code = ''ps'' or @disc_code = ''spl''
		begin		
			delete top (1) from piping.dbo.tdlmr_dtl
				where jmif_no = @jmif_no and
					  stock_no = @stock_no and
					  item_code = @item_code and
					  commodity_code = @commodity_code and
					  size = @size
				
			delete top (1) from piping.dbo.tjwrr_dtl
				where jmif_no = @jmif_no and
					  stock_no = @stock_no and
					  item_code = @item_code and
					  commodity_code = @commodity_code and
					  size = @size
		end
		else if @disc_code = ''cvl'' or @disc_code = ''inst'' or @disc_code = ''ele'' or @disc_code = ''psf''
		begin		
			delete top (1) from piping.dbo.tdlmr_dtl
				where jmif_no = @jmif_no and
					  stock_no = @stock_no and
					  item_code = @item_code and
					  commodity_code = @commodity_code
				
			delete top (1) from piping.dbo.tjwrr_dtl
				where jmif_no = @jmif_no and
					  stock_no = @stock_no and
					  item_code = @item_code and
					  commodity_code = @commodity_code
		end
				  
		delete top (1) t2 from piping.dbo.tdlmr_dtl t
			inner join piping.dbo.tdlmr_hdr t2
			on t.dlmr_no = t2.dlmr_no
			where t2.jmif_no = @jmif_no
				  
		delete top (1) t2 from piping.dbo.tjwrr_dtl t
			inner join piping.dbo.tjwrr_hdr t2
			on t.jwrr_no = t2.jwrr_no
			where t2.jmif_no = @jmif_no
			
		if @disc_code = ''inst'' or @disc_code = ''ele'' or @disc_code = ''psf''
		begin
			update top (1) t
				set jwrr_no = ''''
				from piping.dbo.treqiss_dtl t
				where stock_no = @stock_no and
					  item_code = @item_code and
					  commodity_code = @commodity_code and
					  drawing_no = @drawing_no and
					  spool_no = @spool_no and
					  size = @size and
					  jmif_no = @jmif_no
		end
		else
		begin
			update top (1) t
				set jwrr_no = ''''
				from piping.dbo.treqiss_dtl t
				where plant_no = @plant_no and
					  area_no = @area_no and
					  drawing_no = @drawing_no and
					  sheet_no = @sheet_no and
					  rev_no = @rev_no and
					  spool_no = @spool_no and
					  commodity_code = @commodity_code and
					  size = @size and
					  jmif_no = @jmif_no
		end
		
		fetch next from crs_comp into @jmif_no, @stock_no, @item_code, @commodity_code, @size, @plant_no, @area_no, @drawing_no, @sheet_no, @rev_no, @spool_no
	end
	close crs_comp
	deallocate crs_comp	
	    
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
/****** Object:  StoredProcedure [dbo].[mechMTO_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[mechMTO_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[mechMTO_sp]
	-- Add the parameters for the stored procedure here
	-- <@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	-- <@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;
	
	delete from piping.dbo.equip_mech;
	delete from piping.dbo.iso_mech;
	
	insert into piping.dbo.iso_mech(plant_no,area_no,drawing_no,sheet_no,rev_no,supp_code,iso_stat,log_user,log_date,log_update,flg_status)
		select top 1 
			case when (t2.cphase = ''GREEN FIELD'') then ''1240G'' else (case when (t2.cphase = ''BROWN FIELD'') then ''1240B'' else '''' end) end,
			t2.area, t2.drawingno, ''1'',
			case when (t2.revno != '''') then t2.revno else ''0'' end,
			t2.vendor, ''ACTIVE'', ''sa'', {fn NOW()}, 
			''uploaded by sa '' + CONVERT(nvarchar(max),{fn NOW()}), 1 from (select area, drawingno, revno, eqpt_tag from dbo.tt_uplMech group by area, drawingno, revno, eqpt_tag) as t inner join dbo.tt_uplMech as t2
		on t2.area = t.area and t2.drawingno = t.drawingno and t2.revno = t.revno and t2.eqpt_tag = t.eqpt_tag
		left outer join piping.dbo.iso_mech as t3
		on t3.area_no = t2.area and t3.drawing_no = t2.drawingno and
		   t3.plant_no = case when (t2.cphase = ''GREEN FIELD'') then ''1240G'' else (case when (t2.cphase = ''BROWN FIELD'') then ''1240B'' else '''' end) end and
		   t3.sheet_no = ''1'' and t3.rev_no = case when (t2.revno != '''') then t2.revno else ''0'' end
		where t3.drawing_no is null
		
	insert into piping.dbo.equip_mech(plant_no,area_no,drawing_no,sheet_no,rev_no,equip_no,equip_desc,qty,weight, supp_code, um, designation,log_user,log_date,log_update,flg_status)
		select 
			case when (t.cphase = ''GREEN FIELD'') then ''1240G'' else (case when (t.cphase = ''BROWN FIELD'') then ''1240B'' else '''' end) end,
			t.area, t.drawingno, ''1'',
			case when (t.revno != '''') then t.revno else ''0'' end,
			t.eqpt_tag, upper(ltrim(rtrim(t.eqpt_name))), t.qty, t.eqpt_w_boq,
			t.vendor, ''PC'', t.eqpt_type, ''Uploaded'', {fn NOW()}, 
			''uploaded by sa '' + CONVERT(nvarchar(max),{fn NOW()}), 1 from dbo.tt_uplMech as t 
		left outer join piping.dbo.equip_mech as t2
		on t2.area_no = t.area and t2.drawing_no = t.drawingno and
		   t2.plant_no = case when (t.cphase = ''GREEN FIELD'') then ''1240G'' else (case when (t.cphase = ''BROWN FIELD'') then ''1240B'' else '''' end) end and
		   t2.sheet_no = ''1'' and t2.rev_no = case when (t.revno != '''') then t.revno else ''0'' end and
		   t2.equip_no = t.eqpt_tag
		where t2.drawing_no is null
		
	insert into piping.dbo.material_file(stock_no, item_code, description, unit, size, commodity_code, schedule, mat_type, item, log_user, log_date, uom)
		select 
			t.eqpt_tag, t.eqpt_tag, UPPER(ltrim(rtrim(t.eqpt_name))),'''',
			LTRIM(RTRIM(str(t.eqpt_w_boq))), t.eqpt_tag, '''', t.eqpt_type,
			t.eqpt_type, ''Uploaded'', {fn NOW()}, ''PC''
			from dbo.tt_uplMech as t 
		left outer join piping.dbo.material_file as t2
		on t2.stock_no = t.eqpt_tag and t2.item_code = t.eqpt_tag and
		   t2.commodity_code = t.eqpt_tag
		where t2.stock_no is null
		
	insert into piping.dbo.material_file_dtl(disc_code, disc_desc, stock_no, item_code, commodity_code, flg_status, log_user, log_date)
		select 
			''MECH'', ''MECHANICAL'', t.eqpt_tag, t.eqpt_tag, t.eqpt_tag,
			1, ''UPLOADED'', {fn NOW()}
			from dbo.tt_uplMech as t 
		left outer join piping.dbo.material_file_dtl as t2
		on t2.stock_no = t.eqpt_tag and t2.item_code = t.eqpt_tag and
		   t2.commodity_code = t.eqpt_tag and t2.disc_code = ''MECH''
		where t2.stock_no is null

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
/****** Object:  StoredProcedure [dbo].[matTakeOff_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[matTakeOff_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[matTakeOff_sp]
	@ip_module as varchar(max),
	@ip_loguser as varchar(max),
	@ip_disc_code as varchar(max),
	@ip_drawing_no as varchar(max),
	@ip_sheet_no as varchar(max)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;

    -- Insert statements for procedure here
	delete from ttTempS;
	--select @ip_module, @ip_loguser, @ip_disc_code, @ip_drawing_no, @ip_sheet_no;
	if @ip_module = ''jwrr''
	begin
		set identity_insert ttTempS on;
		insert into ttTempS(jmif_no,stock_no,item_code,commodity_code,mat_desc,uom,measurement,size,activity_code,req_qty,iss_qty,drawing_no,direct_with,testpack_no,system_no,sub_system,mat_util,mat_status,log_user,log_date,log_time,log_update,spl_type,disc_code,disc_desc,support_no,dlmr_jwrr,sheet_no,rev_no,area_no,rfi_no,qcmrir_no,spool_no,excess,issue_date,issued_by,recvd_by,supp_code,pl_dn_inv,pr_po_no,frecid,jwrr_no,plant_no,isc_no,PROGRESS_RECID,PROGRESS_RECID_IDENT_)
			select t.* from piping.dbo.treqiss_dtl t inner join (
				select MAX(PROGRESS_RECID) AS PROGRESS_RECID from piping.dbo.treqiss_dtl where jwrr_no = '''' AND disc_code = ''PIP'' AND req_qty > iss_qty GROUP BY jmif_no, commodity_code, size
			) t2
			on t.PROGRESS_RECID = t2.PROGRESS_RECID;
			
		update t
			set t.req_qty = t2.req_qty
			from ttTempS as t inner join (
				select MAX(PROGRESS_RECID) AS PROGRESS_RECID, jmif_no, commodity_code, size, (SUM(req_qty) - SUM(iss_qty)) as req_qty from piping.dbo.treqiss_dtl GROUP BY jmif_no, commodity_code, size
			) t2 
			on t.PROGRESS_RECID = t2.PROGRESS_RECID;
	end
	else
	begin
		declare @disc_shop as tinyint;
		declare @disc_field as tinyint;
		
		select top 1 @disc_field = disc_field, @disc_shop = disc_shop
			from piping.dbo.ruser_disc
			where user_id = @ip_loguser and
				  disc_code = @ip_disc_code and
				  flg_status = 1
		
		if (lower(@ip_disc_code) = ''strl'')
		begin
			insert into ttTempS(plant_no, area_no, area_loc, drawing_no, sheet_no, rev_no, drawing_no2, sheet_no2, rev_no2, drawing_no3, sheet_no3, rev_no3, commodity_code, mat_desc, location, elevation, size, uom, measurement, qty, spool_no, disc_code)
				select t2.plant_no, t2.area_no, t2.area_loc, t2.drawing_no, t2.sheet_no, t2.rev_no, ISNULL(t.drawing_no2,''''), ISNULL(t.sheet_no2,''''), ISNULL(t.rev_no2,''''), ISNULL(t.drawing_no3,''''), ISNULL(t.sheet_no3,''''), ISNULL(t.rev_no3,''''), t2.piece_no, t2.piece_desc, t2.location, t2.elevation, convert(varchar, t2.weight), t2.um, t2.length, t2.qty, ISNULL(t.rack_no,''''), @ip_disc_code
					from piping.dbo.iso_struc t
					inner join piping.dbo.piece_struc t2
					on t.plant_no = t2.plant_no and
					   t.area_no = t2.area_no and
					   t.area_loc = t2.area_loc and
					   t.drawing_no = t2.drawing_no and
					   t.sheet_no = t2.sheet_no and
					   t.rev_no = t2.rev_no
					inner join (
						select max(PROGRESS_RECID) as PROGRESS_RECID from piping.dbo.piece_struc
							where qty != reqd_qty
							group by plant_no, area_no, area_loc, drawing_no, sheet_no, rev_no, piece_no, weight, (qty - reqd_qty)
					) t3
					on t2.PROGRESS_RECID = t3.PROGRESS_RECID
					where (@ip_drawing_no = ''<ALL>'') or
						  (@ip_drawing_no != ''<ALL>'' and t2.drawing_no = @ip_drawing_no) or
						  (@ip_drawing_no != ''<ALL>'' and t.drawing_no2 = @ip_drawing_no) or
						  (@ip_drawing_no != ''<ALL>'' and t.drawing_no3 = @ip_drawing_no);
		end
		else if (lower(@ip_disc_code) = ''ps'') or (lower(@ip_disc_code) = ''psf'')
		begin
			insert into ttTempS(plant_no, area_no, drawing_no, sheet_no, rev_no, mat_desc, item_code, commodity_code, size, mat_tag, spl_type, uom, qty, designation, mat_prof, spool_no, support_no, ps_type, disc_code)
				select plant_no, area_no, drawing_no, sheet_no, rev_no, max(isnull(ps_matl,'''') + '' PS Spec: '' + isnull(ps_specs,'''') + '' PS Code: '' + isnull(ps_code,'''') + '' PS Type: '' + isnull(ps_type,'''') + '' PS Class: '' + isnull(ps_class,'''') + '' Category: '' + isnull(category,'''')), ps_code, max(isnull(ps_code,'''')), line_size, max(isnull(mat_tag,'''')), max(isnull(ps_class,'''')), max(isnull(um,'''')), wt_fab, max(isnull(category,'''')), max(isnull(ps_matl,'''')), spool_no, max(isnull(com_code,'''')), max(isnull(ps_type,'''')), @ip_disc_code
					from piping.dbo.ps_mto
					where (@ip_drawing_no = ''<ALL>'' and @ip_sheet_no = ''<ALL>'') or
						  (@ip_drawing_no != ''<ALL>'' and drawing_no = @ip_drawing_no and @ip_sheet_no = ''<ALL>'') or
						  (@ip_drawing_no = ''<ALL>'' and @ip_sheet_no != ''<ALL>'' and sheet_no = @ip_sheet_no) or
						  (@ip_drawing_no != ''<ALL>'' and drawing_no = @ip_drawing_no and @ip_sheet_no != ''<ALL>'' and sheet_no = @ip_sheet_no)
					group by plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, ps_code, line_size, wt_fab;
		end
		else if (lower(@ip_disc_code) = ''inst'')
		begin
			insert into ttTempS(area_no, drawing_no, sheet_no, rev_no, mat_desc, stock_no, uom, qty, spl_type, designation, disc_code)
				select loc_code, drawing_no, sheet_no, rev_no, isnull(tag_desc,''''), tag_no, uom, qty, max(isnull(tag_type,'''')), max(isnull(category,'''')), @ip_disc_code
					from piping.dbo.inst_takeoff
					where (@ip_drawing_no = ''<ALL>'' and @ip_sheet_no = ''<ALL>'') or
						  (@ip_drawing_no != ''<ALL>'' and drawing_no = @ip_drawing_no and @ip_sheet_no = ''<ALL>'') or
						  (@ip_drawing_no = ''<ALL>'' and @ip_sheet_no != ''<ALL>'' and sheet_no = @ip_sheet_no) or
						  (@ip_drawing_no != ''<ALL>'' and drawing_no = @ip_drawing_no and @ip_sheet_no != ''<ALL>'' and sheet_no = @ip_sheet_no)
					group by loc_code, drawing_no, sheet_no, rev_no, tag_desc, tag_no, uom, qty;
		end
		else if (lower(@ip_disc_code) = ''ele'')
		begin
			insert into ttTempS(drawing_no, sheet_no, rev_no, mat_desc, stock_no, commodity_code, uom, qty, spl_type, designation, disc_code)
				select drawing_no, sheet_no, rev_no, isnull(tag_desc,''''), tag_no, (select top (1) t2.commodity_code from piping.dbo.material_file t2 where t2.stock_no = t.tag_no), uom, qty, max(isnull(ele_type,'''')), max(isnull(elec_sys_id,'''')), @ip_disc_code
					from piping.dbo.elec_takeoff t
					where (@ip_drawing_no = ''<ALL>'' and @ip_sheet_no = ''<ALL>'') or
						  (@ip_drawing_no != ''<ALL>'' and drawing_no = @ip_drawing_no and @ip_sheet_no = ''<ALL>'') or
						  (@ip_drawing_no = ''<ALL>'' and @ip_sheet_no != ''<ALL>'' and sheet_no = @ip_sheet_no) or
						  (@ip_drawing_no != ''<ALL>'' and drawing_no = @ip_drawing_no and @ip_sheet_no != ''<ALL>'' and sheet_no = @ip_sheet_no)
					group by drawing_no, sheet_no, rev_no, tag_desc, tag_no, uom, qty;
		end
		else if (lower(@ip_disc_code) = ''spl'')
		begin
			insert into ttTempS(plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, spl_type, stock_no, item_code, commodity_code, size, uom, qty, testpack_no, disc_code)
				select plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, ''Spool'', (drawing_no + ''-'' + spool_no), spool_no, spool_no, ''1'', ''PC'', 1, max(isnull(testpack_no,'''')), @ip_disc_code
					from piping.dbo.spool t
					where (@ip_drawing_no = ''<ALL>'' and @ip_sheet_no = ''<ALL>'') or
						  (@ip_drawing_no != ''<ALL>'' and drawing_no = @ip_drawing_no and @ip_sheet_no = ''<ALL>'') or
						  (@ip_drawing_no = ''<ALL>'' and @ip_sheet_no != ''<ALL>'' and sheet_no = @ip_sheet_no) or
						  (@ip_drawing_no != ''<ALL>'' and drawing_no = @ip_drawing_no and @ip_sheet_no != ''<ALL>'' and sheet_no = @ip_sheet_no) and
						  received_date != null and
						  issued_date != null
					group by plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no;
		end
		else
		begin
			insert into ttTempS(plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, spl_type, stock_no, item_code, commodity_code, size, req_qty, qty, testpack_no, frecid, itemno, mat_desc, uom, category, disc_code)
				select plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, max(spl_type), commodity_code, max(isnull(item_code,'''')), commodity_code, size, (qty - reqd_qty), max(qty), max(isnull(testpack_no,'''')), max(PROGRESS_RECID), isnull(isc_no,''''), max(isnull(mat_desc,'''')), max(isnull(uom,'''')), max(isnull(category,'''')), @ip_disc_code
					from piping.dbo.mat_takeoff_perspool
					where (@disc_shop = 1 and @disc_field = 1) or
						  (@disc_shop = 1 and @disc_field != 1 and spl_type = ''Spool'') or
						  (not (@disc_shop = 1 and @disc_field = 1) and not (@disc_shop = 1 and @disc_field != 1) and upper(spl_type) in (''EM'',''FIELD'')) and
						  (@ip_drawing_no = ''<ALL>'' and @ip_sheet_no = ''<ALL>'') or
						  (@ip_drawing_no != ''<ALL>'' and drawing_no = @ip_drawing_no and @ip_sheet_no = ''<ALL>'') or
						  (@ip_drawing_no = ''<ALL>'' and @ip_sheet_no != ''<ALL>'' and sheet_no = @ip_sheet_no) or
						  (@ip_drawing_no != ''<ALL>'' and drawing_no = @ip_drawing_no and @ip_sheet_no != ''<ALL>'' and sheet_no = @ip_sheet_no)
					group by plant_no, area_no, drawing_no, sheet_no, rev_no, spool_no, commodity_code, size, isc_no, (qty - reqd_qty);
		end
	end
	
	--select * from dbo.ttTempS where disc_code = ''PIP'';
	
	--select @disc_field, @disc_shop;
		
	--merge dbo.ttTempS as target
	--	using (select *) as src
	--	on (target.disc_code = ''PIP'' and
	--		target.req_qty > iss_qty)
	--	when matched then
	--		update set req_qty = SUM(target.req_qty) - SUM(src.iss_qty);
	--insert into ttTempS(PROGRESS_RECID, jmif_no, stock_no, item_code, commodity_code, size, req_qty)
	--	SELECT MAX(PROGRESS_RECID) AS PROGRESS_RECID, 
	--		   jmif_no, 
	--		   MAX(stock_no) AS stock_no, 
	--		   MAX(item_code) AS item_code, 
	--		   commodity_code, 
	--		   size, 
	--		   SUM(req_qty) - SUM(iss_qty) AS req_qty
	--	FROM piping.dbo.treqiss_dtl
	--	WHERE jwrr_no = '''' AND 
	--		  disc_code = ''PIP'' AND 
	--		  req_qty > iss_qty
	--	GROUP BY jmif_no, 
	--			 commodity_code, 
	--			 size
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
/****** Object:  StoredProcedure [dbo].[ttMTO_upd1_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[ttMTO_upd1_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[ttMTO_upd1_sp]
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	if (exists(select top 1 * from qms_atrail.dbo.twhse_mat_ps))
	begin	
		update t
			set t.reqd_qty = t2.rec_qty,
				t.ref_rec_qty = t2.rec_qty,
				t.ref_rec_date = (case when(t.ref_rec_qty >= t.iso_qty) then t2.ref_date else t.ref_rec_date end)
			from piping.dbo.ps_mto_hdr t
			inner join qms_pip.dbo.twhse_mat_ps t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type	
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no;
			   
		insert into #ttCountPS
			select max(t4.plant_no), 
				   max(t4.area_no), 
				   max(t.drawing_no), 
				   max(t4.sheet_no), 
				   max(t4.spool_no), 
				   max(t.ps_code), 
				   max(t.ps_type),
				   sum(case when(t.ref_rec_qty >= t.iso_qty) then 0 else 1 end),
				   sum(case when(t.ref_rec_qty >= t.iso_qty) then 1 else 0 end),
				   null
				from piping.dbo.ps_mto_hdr t
				inner join qms_pip.dbo.twhse_mat_ps t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.mat_takeoff_perspool t4
				on t3.plant_no = t4.plant_no and
				   t3.area_no = t4.area_no and
				   t3.drawing_no = t4.drawing_no and
				   t3.sheet_no = t4.sheet_no;
			   
		update t
			set t.ref_rec_no = (case when(t.ref_rec_no = '''') then t4.ref_no else(t.ref_rec_no + ''/'' + t4.ref_no) end),
				t.ref_rec_date = t4.ref_date,
				t.ref_rec_qty = t.wt_fab,
				t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.client_ref_no else(t.ref_iss_no + ''/'' + t4.client_ref_no) end)
			from piping.dbo.ps_mto t
			inner join piping.dbo.ps_mto_hdr t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type			
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			inner join qms_pip.dbo.twhse_mat_ps t4
			on t.drawing_no = t4.drawing_no and
			   t.ps_code = t4.ps_code and
			   t.ps_type = t4.ps_type
			inner join piping.dbo.mat_takeoff_perspool t5
			on t3.plant_no = t5.plant_no and
			   t3.area_no = t5.area_no and
			   t3.drawing_no = t5.drawing_no and
			   t3.sheet_no = t5.sheet_no;
			   
		update t set icnt1_ps = COUNT(t2.drawing_no)
			from #ttCountPS t
			inner join piping.dbo.ps_mto_hdr t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			right outer join qms_pip.dbo.twhse_mat_ps t4
			on t2.drawing_no = t4.drawing_no and
			   t2.ps_code = t4.ps_code and
			   t2.ps_type = t4.ps_type
			inner join piping.dbo.mat_takeoff_perspool t5
			on t3.plant_no = t5.plant_no and
			   t3.area_no = t5.area_no and
			   t3.drawing_no = t5.drawing_no and
			   t3.sheet_no = t5.sheet_no;
			   
		update t
			set t.ref_rec_no = (case when(t.ref_rec_no = '''') then (''JWRR-'' + t4.jmif_no) else(t.ref_rec_no + ''/JWRR-'' + t4.jmif_no) end),
				t.ref_rec_date = t4.issue_date,
				t.ref_rec_qty = t.wt_fab,
				t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.jmif_no else(t.ref_iss_no + ''/'' + t4.jmif_no) end)
			from piping.dbo.ps_mto t
			inner join piping.dbo.ps_mto_hdr t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			inner join piping.dbo.treqiss_dtl t4
			on t.drawing_no = t4.drawing_no and
			   t.ps_code = t4.stock_no and
			   t.ps_code = t4.item_code and
			   t.ps_code = t4.commodity_code and
			   t.mat_tag = t4.isc_no
			inner join piping.dbo.mat_takeoff_perspool t5
			on t3.plant_no = t5.plant_no and
			   t3.area_no = t5.area_no and
			   t3.drawing_no = t5.drawing_no and
			   t3.sheet_no = t5.sheet_no;
	end
	else
	begin		
		if (exists(select top 1 * from qms_pip.dbo.twhse_mat_ps_ch))
		begin
			declare @cutoff_date as date
			set @cutoff_date = (select top 1 cutoff_date from qms_pip.dbo.twhse_mat_ps_ch);
			update t
				set reqd_qty = t3.rec_qty,
					ref_rec_qty = t3.rec_qty
				from piping.dbo.ps_mto_hdr t
				inner join piping.dbo.iso t2
				on t.drawing_no = t2.drawing_no
				inner join qms_pip.dbo.twhse_mat_ps_dtl t3
				on t.drawing_no = t3.drawing_no and
				   t.ps_code = t3.ps_code and
				   t.ps_type = t3.ps_type
				inner join piping.dbo.mat_takeoff_perspool t4
				on t3.plant_no = t4.plant_no and
				   t3.area_no = t4.area_no and
				   t3.drawing_no = t4.drawing_no and
				   t3.sheet_no = t4.sheet_no
				where t3.cutoff_date = @cutoff_date
				   
			insert into #ttCountPS
				select max(t4.plant_no), 
					   max(t4.area_no), 
					   max(t.drawing_no), 
					   max(t4.sheet_no), 
					   max(t4.spool_no), 
					   max(t.ps_code), 
					   max(t.ps_type),
					   sum(case when(t.ref_rec_qty >= t.iso_qty) then 1 else 0 end),
					   sum(case when(t.ref_rec_qty >= t.iso_qty) then 0 else 1 end),
					   max(t3.cutoff_date)
					from piping.dbo.ps_mto_hdr t
					inner join piping.dbo.iso t2
					on t.drawing_no = t2.drawing_no
					inner join qms_pip.dbo.twhse_mat_ps_dtl t3
					on t.drawing_no = t3.drawing_no and
					   t.ps_code = t3.ps_code and
					   t.ps_type = t3.ps_type
					inner join piping.dbo.mat_takeoff_perspool t4
					on t3.plant_no = t4.plant_no and
					   t3.area_no = t4.area_no and
					   t3.drawing_no = t4.drawing_no and
					   t3.sheet_no = t4.sheet_no
					where t3.cutoff_date = @cutoff_date;
				   
			update t
				set t.ref_rec_no = (case when(t.ref_rec_no = '''') then t4.ref_no else(t.ref_rec_no + ''/'' + t4.ref_no) end),
					t.ref_rec_date = t4.ref_date,
					t.ref_rec_qty = t.wt_fab,
					t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.client_ref_no else(t.ref_iss_no + ''/'' + t4.client_ref_no) end)
				from piping.dbo.ps_mto t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type			
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join qms_pip.dbo.twhse_mat_ps_dtl t4
				on t.drawing_no = t4.drawing_no and
				   t.ps_code = t4.ps_code and
				   t.ps_type = t4.ps_type
				inner join piping.dbo.mat_takeoff_perspool t5
				on t3.plant_no = t5.plant_no and
				   t3.area_no = t5.area_no and
				   t3.drawing_no = t5.drawing_no and
				   t3.sheet_no = t5.sheet_no
				where t4.cutoff_date = @cutoff_date;
				   
			update t set icnt1_ps = COUNT(t2.drawing_no)
				from #ttCountPS t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type	
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				right outer join qms_pip.dbo.twhse_mat_ps_dtl t4
				on t2.drawing_no = t4.drawing_no and
				   t2.ps_code = t4.ps_code and
				   t2.ps_type = t4.ps_type
				inner join piping.dbo.mat_takeoff_perspool t5
				on t3.plant_no = t5.plant_no and
				   t3.area_no = t5.area_no and
				   t3.drawing_no = t5.drawing_no and
				   t3.sheet_no = t5.sheet_no
				where t4.cutoff_date = @cutoff_date;
				   
			update t
				set t.ref_rec_no = (case when(t.ref_rec_no = '''') then (''JWRR-'' + t4.jmif_no) else(t.ref_rec_no + ''/JWRR-'' + t4.jmif_no) end),
					t.ref_rec_date = t4.issue_date,
					t.ref_rec_qty = t.wt_fab,
					t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.jmif_no else(t.ref_iss_no + ''/'' + t4.jmif_no) end)
				from piping.dbo.ps_mto t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.treqiss_dtl t4
				on t.drawing_no = t4.drawing_no and
				   t.ps_code = t4.stock_no and
				   t.ps_code = t4.item_code and
				   t.ps_code = t4.commodity_code and
				   t.mat_tag = t4.isc_no
				right outer join qms_pip.dbo.twhse_mat_ps_dtl t5
				on t2.drawing_no = t5.drawing_no and
				   t2.ps_code = t5.ps_code and
				   t2.ps_type = t5.ps_type
				inner join piping.dbo.mat_takeoff_perspool t6
				on t3.plant_no = t6.plant_no and
				   t3.area_no = t6.area_no and
				   t3.drawing_no = t6.drawing_no and
				   t3.sheet_no = t6.sheet_no
				where t5.cutoff_date = @cutoff_date;
		end
		else
		begin				   
			update t set icnt1_ps = COUNT(t2.drawing_no)
				from #ttCountPS t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type	
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.mat_takeoff_perspool t4
				on t3.plant_no = t4.plant_no and
				   t3.area_no = t4.area_no and
				   t3.drawing_no = t4.drawing_no and
				   t3.sheet_no = t4.sheet_no;
				   
			update t
				set t.ref_rec_no = (case when(t.ref_rec_no = '''') then (''JWRR-'' + t4.jmif_no) else(t.ref_rec_no + ''/JWRR-'' + t4.jmif_no) end),
					t.ref_rec_date = t4.issue_date,
					t.ref_rec_qty = t.wt_fab,
					t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.jmif_no else(t.ref_iss_no + ''/'' + t4.jmif_no) end)
				from piping.dbo.ps_mto t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.treqiss_dtl t4
				on t.drawing_no = t4.drawing_no and
				   t.ps_code = t4.stock_no and
				   t.ps_code = t4.item_code and
				   t.ps_code = t4.commodity_code and
				   t.mat_tag = t4.isc_no
				inner join piping.dbo.mat_takeoff_perspool t5
				on t3.plant_no = t5.plant_no and
				   t3.area_no = t5.area_no and
				   t3.drawing_no = t5.drawing_no and
				   t3.sheet_no = t5.sheet_no;
		end
	end
	
	create table #ttPSH(
		drawing_no varchar(max),
		ps_code varchar(max),
		ps_type varchar(max),
		cnt_nc int,
		cnt_c int
	);
	
	merge #ttPSH as target
	using (select t.drawing_no, t.ps_code, t.ps_type 
				from piping.dbo.ps_mto t
				inner join piping.dbo.iso t2
				on t.drawing_no = t2.drawing_no) as src
		  (drawing_no, ps_code, ps_type)
	on (target.drawing_no = src.drawing_no and
	    target.ps_code = src.ps_code and
	    target.ps_type = src.ps_type)
	when not matched then
		insert (drawing_no, ps_code, ps_type, cnt_nc, cnt_c)
		values (src.drawing_no, src.ps_code, src.ps_type, (case when(src.wt_fab != 0 AND src.ref_rec_qty < src.wt_fab) then 1 else 0 end), (case when(src.wt_fab != 0 AND src.ref_rec_qty >= src.wt_fab) then 1 else 0 end))
	when matched then
		update set cnt_nc = (case when(src.wt_fab != 0 AND src.ref_rec_qty < src.wt_fab) then 1 else 0 end), 
				   cnt_n = (case when(src.wt_fab != 0 AND src.ref_rec_qty >= src.wt_fab) then 1 else 0 end);

	update top (1) t set percent_workable = t2.cnt_c / ((t2.cnt_nc + t2.cnt_c) * 100)
		from piping.dbo.ps_mto_hdr t
		inner join #ttPSH t2
		on t.drawing_no = t2.drawing_no and
		   t.ps_code = t2.ps_code and
		   t.ps_type = t2.ps_type
		inner join piping.dbo.iso t3
		on t2.drawing_no = t3.drawing_no;
	SET NOCOUNT OFF;
END
' 
END
GO
/****** Object:  StoredProcedure [dbo].[ttMTO_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[ttMTO_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[ttMTO_sp]
	@ip_refrecno varchar(max),
	@ip_refrecdate date,
	@ip_suppcode varchar(max),
	@ip_suppdesc varchar(max),
	@ip_prpono varchar(max),
	@ip_pldninv varchar(max),
	@ip_recby varchar(max),
	@ip_recdate date,
	@ip_qcmrirno varchar(max),
	@ip_qcmrirdate date,
	@ip_rfino varchar(max),
	@ip_rfidate date,
	@ip_refissno varchar(max),
	@ip_refrem varchar(max),
	@ip_loguser varchar(max),
	@ip_precid varchar(max)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	BEGIN TRANSACTION;
	
	IF OBJECT_ID(''tempdb...#ttCountPS'') IS NOT NULL
	BEGIN
		DROP TABLE #ttCountPS
	END
	create table #ttCountPS (
		plant_no varchar(max),
		area_no varchar(max),
		drawing_no varchar(max),
		sheet_no varchar(max),
		spool_no varchar(max),
		ps_code varchar(max),
		ps_type varchar(max),
		icnt1_ps int,
		icnt2_ps int,
		cutoff_date date
	)
	
	IF OBJECT_ID(''tempdb...#ttCountSpl'') IS NOT NULL
	BEGIN
		DROP TABLE #ttCountSpl
	END
	create table #ttCountSpl (
		plant_no varchar(max),
		area_no varchar(max),
		drawing_no varchar(max),
		sheet_no varchar(max),
		spool_no varchar(max),
		icnt1_spl int,
		icnt2_spl int
	)
	
	IF OBJECT_ID(''tempdb...#ttCountEM'') IS NOT NULL
	BEGIN
		DROP TABLE #ttCountEM
	END
	create table #ttCountEM(
		plant_no varchar(max),
		area_no varchar(max),
		drawing_no varchar(max),
		sheet_no varchar(max),
		spool_no varchar(max),
		icnt1_em int,
		icnt2_em int
	);
	
	IF OBJECT_ID(''tempdb...#ttISO'') IS NOT NULL
	BEGIN
		DROP TABLE #ttISO
	END
	create table #ttISO(
		drawing_no varchar(max),
		sheet_no varchar(max)
	);
	
	insert into piping.dbo.tjwrr_hdr(jwrr_no, disc_code, disc_desc, log_user, log_date, log_time, jwrr_date, supp_code, supp_desc, pr_po_no, pl_dn_inv, rcvd_by, rcvd_date, qcmrir_no, qcmrir_date, rfi_no, rfi_date, jmif_no, remarks, log_update)
		values(@ip_refrecno, ''PIP'', ''PIPING'', ''UPLOAD BY'' + @ip_loguser, {fn NOW()}, convert(time,CURRENT_TIMESTAMP), @ip_refrecdate, @ip_suppcode, @ip_suppdesc, @ip_prpono, @ip_pldninv, @ip_recby, @ip_recdate, @ip_qcmrirno, @ip_qcmrirdate, @ip_rfino, @ip_rfidate, @ip_refissno, @ip_refrem, (@ip_loguser + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))));
			
	declare @rec_qty decimal(17,2)
	declare @item_code varchar(max)
	declare @mat_desc varchar(max)
	declare @commodity_code varchar(max)
	declare @uom varchar(max)
	declare @size varchar(max)
	declare @area_no varchar(max)
	declare @drawing_no varchar(max)
	declare @sheet_no varchar(max)
	declare @rev_no varchar(max)
	declare @dtl_rem varchar(max)
	declare @PROGRESS_RECID bigint
	declare crs cursor read_only
		for select rec_qty, item_code, mat_desc, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, dtl_rem from tempdb_sql.dbo.ttmto where convert(varchar,PROGRESS_RECID) in (@ip_precid)
			
	open crs
	fetch next from crs into @rec_qty, @item_code, @mat_desc, @commodity_code, @uom, @size, @area_no, @drawing_no, @sheet_no, @rev_no, @dtl_rem
	while @@FETCH_STATUS = 0
	begin

		insert into #ttISO	
			select drawing_no, sheet_no
				from piping.dbo.mat_takeoff_perspool where PROGRESS_RECID = @PROGRESS_RECID group by drawing_no, sheet_no
			
		update t
			set ref_rec_no = case when(ref_rec_no = '''') then @ip_refrecno else(ref_rec_no + ''/'' + @ip_refrecno) end,
				ref_rec_date = @ip_refrecdate,
				ref_rec_qty = ref_rec_qty + @rec_qty,
				ref_iss_no = case when(ref_iss_no = '''') then @ip_refissno else(ref_iss_no + ''/'' + @ip_refissno) end
			from piping.dbo.mat_takeoff_perspool t where PROGRESS_RECID = @PROGRESS_RECID				
		
		insert into piping.dbo.tjwrr_dtl(jwrr_no, stock_no, stock_desc, item_code, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, remarks, jmif_no, disc_code, rcvd_date, log_user, log_date, jwrr_qty, log_update)
			values(@ip_refrecno, @item_code, @mat_desc, @item_code, @commodity_code, @uom, @size, @area_no, @drawing_no, @sheet_no, @rev_no, @dtl_rem, @ip_refissno, ''PIP'', @ip_recdate, ''UPLOADED BY '' + @ip_loguser, {fn NOW()}, @rec_qty, (@ip_loguser + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))));
		
		merge piping.dbo.material_file as target
		using (select @item_code, @commodity_code, @size, @uom) as src
			  (item_code, commodity_code, size, uom)
		on (target.stock_no = src.item_code and
			target.item_code = src.item_code and
			target.commodity_code = src.commodity_code and
			target.size = src.size
		   )
		when not matched then
			insert (stock_no, item_code, commodity_code, size, uom, flg_status)
			values (src.item_code, src.item_code, src.commodity_code, src.size, src.uom, 1);
			
		merge piping.dbo.material_file_dtl as target
		using (select @item_code, @commodity_code) as src
			  (item_code, commodity_code)
		on (target.stock_no = src.item_code and
			target.item_code = src.item_code and
			target.commodity_code = src.commodity_code and
			target.disc_code = ''PIP''
		   )
		when not matched then
			insert (stock_no, item_code, commodity_code, disc_code, flg_status)
			values (src.item_code, src.item_code, src.commodity_code, ''PIP'', 1);
		
		fetch next from crs into @rec_qty, @item_code, @mat_desc, @commodity_code, @uom, @size, @area_no, @drawing_no, @sheet_no, @rev_no, @dtl_rem
	end
	close crs
	deallocate crs
	
	-- proc_iso_upd
	
	--declare @icnt1_em int;
	--declare @icnt2_em int;
	--select @icnt1_em = sum(case when(t.ref_rec_qty < t.qty) then 1 else 0 end),
	--	   @icnt2_em = sum(case when(t.ref_rec_qty >= t.qty) then 1 else 0 end) 
	--	from piping.dbo.mat_takeoff_perspool t
	--	inner join #ttISO t2
	--	on t.drawing_no = t2.drawing_no and
	--	   t.sheet_no = t2.sheet_no
	--	where lower(t.spool_no) = ''em''
	--	group by t.drawing_no, t.sheet_no, t.spool_no;
	
	insert into #ttCountEM
		select MAX(t.plant_no) as plant_no,
			   MAX(t.area_no) as area_no,
			   t.drawing_no, 
			   t.sheet_no, 
			   t.spool_no,
			   sum(case when(t.ref_rec_qty < t.qty) then 1 else 0 end),
			   sum(case when(t.ref_rec_qty >= t.qty) then 1 else 0 end)
			from piping.dbo.mat_takeoff_perspool t
			inner join #ttISO t2
			on t.drawing_no = t2.drawing_no and
			   t.sheet_no = t2.sheet_no
			where lower(t.spool_no) = ''em''
			group by t.drawing_no, t.sheet_no, t.spool_no;

	IF OBJECT_ID(''tempdb...#ttSPL'') IS NOT NULL
	BEGIN
		DROP TABLE #ttSPL
	END
	create table #ttSPL(
		drawing_no varchar(max),
		spool_no varchar(max),
		cnt_c int,
		cnt_nc int
	);
	
	merge #ttSPL as target
	using (select t.drawing_no, spool_no from piping.dbo.mat_takeoff_perspool t
		inner join #ttISO t2
		on t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no
		where lower(t.spool_no) != ''em'' and
			  t.ref_rec_qty < t.qty
		group by t.drawing_no, t.sheet_no, t.spool_no) as src
		(drawing_no, spool_no)
	on (target.drawing_no = src.drawing_no and
		target.spool_no = src.spool_no)
	when not matched then
		insert (drawing_no, spool_no, cnt_nc)
		values (src.drawing_no, src.spool_no, 1)
	when matched then
		update set cnt_nc = cnt_nc + 1;
	
	merge #ttSPL as target
	using (select t.drawing_no, spool_no from piping.dbo.mat_takeoff_perspool t
		inner join #ttISO t2
		on t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no
		where lower(t.spool_no) != ''em'' and
			  t.ref_rec_qty >= t.qty
		group by t.drawing_no, t.sheet_no, t.spool_no) as src
		(drawing_no, spool_no)
	on (target.drawing_no = src.drawing_no and
		target.spool_no = src.spool_no)
	when not matched then
		insert (drawing_no, spool_no, cnt_c)
		values (src.drawing_no, src.spool_no, 1)
	when matched then
		update set cnt_c = cnt_c + 1;

	update t
		set t.ref_rec_date = (case when(lower(t.spool_no) != ''em'') then(select t2.ref_date from qms_pip.dbo.twhse_mat_spl t2 where t2.drawing_no = t.drawing_no and t2.spool_no = t.spool_no) else t.ref_rec_date end),
			t.ref_rec_qty = (case when(lower(t.spool_no) != ''em'') then(select 1 from qms_pip.dbo.twhse_mat_spl t2 where t2.drawing_no = t.drawing_no and t2.spool_no = t.spool_no) else t.ref_rec_qty end),
			t.percent_workable = (case when((t5.icnt1_em + t5.icnt2_em) != 0) then((t5.icnt2_em / (t5.icnt1_em + t5.icnt2_em)) * 100) else 0 end)
		from piping.dbo.spool t
		inner join piping.dbo.iso t3
		on t.plant_no = t3.plant_no and
		   t.area_no = t3.area_no and
		   t.drawing_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no and
		   t.rev_no = t3.rev_no
		inner join #ttCountEM t5
		on t3.plant_no = t5.plant_no and
		   t3.area_no = t5.area_no and
		   t3.drawing_no = t5.drawing_no and
		   t3.sheet_no = t5.sheet_no
		inner join (
			select plant_no, area_no, drawing_no, sheet_no, spool_no from piping.dbo.mat_takeoff_perspool group by plant_no, area_no, drawing_no, sheet_no, spool_no
		) t4
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no
		where lower(t4.spool_no) = ''em'';
		   
	insert into #ttCountSPL
		select MAX(t.plant_no),
			   MAX(t.area_no),
			   max(t.drawing_no), 
			   max(t.sheet_no), 
			   max(t.spool_no),
			   0 as ict1_spl,
			   count(t5.drawing_no)
			from piping.dbo.spool t
			inner join piping.dbo.iso t3
			on t.plant_no = t3.plant_no and
			   t.area_no = t3.area_no and
			   t.drawing_no = t3.drawing_no and
			   t.sheet_no = t3.sheet_no and
			   t.rev_no = t3.rev_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no
			inner join qms_pip.dbo.twhse_mat_spl t5
			on t4.drawing_no = t5.drawing_no and
			   t4.sheet_no = t5.sheet_no
			where lower(t4.spool_no) = ''em''
			group by t4.drawing_no, t4.sheet_no, t4.spool_no;
		   
	insert into #ttCountSPL
		select MAX(t.plant_no),
			   MAX(t.area_no),
			   max(t.drawing_no), 
			   max(t.sheet_no), 
			   max(t.spool_no),
			   count(t5.drawing_no),
			   0
			from piping.dbo.spool t
			inner join piping.dbo.iso t3
			on t.plant_no = t3.plant_no and
			   t.area_no = t3.area_no and
			   t.drawing_no = t3.drawing_no and
			   t.sheet_no = t3.sheet_no and
			   t.rev_no = t3.rev_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no
			right outer join qms_pip.dbo.twhse_mat_spl t5
			on t4.drawing_no = t5.drawing_no and
			   t4.sheet_no = t5.sheet_no
			where lower(t4.spool_no) = ''em''
			group by t4.drawing_no, t4.sheet_no, t4.spool_no;
			   
	update t
		set ref_rec_date = (case when(lower(t.spool_no) != ''em'') then(select ref_date from qms_pip.dbo.twhse_mat_spl t2 where t2.drawing_no = t.drawing_no and t2.spool_no = t.spool_no) else t.ref_rec_date end),
			ref_rec_qty = (case when(lower(t.spool_no) != ''em'') then(select 1 from qms_pip.dbo.twhse_mat_spl t2 where t2.drawing_no = t.drawing_no and t2.spool_no = t.spool_no) else t.ref_rec_qty end),
			percent_workable = (case when((t6.cnt_nc + t6.cnt_c) != 0) then((t6.cnt_c / (t6.cnt_nc + t6.cnt_c)) * 100) else 0 end)
		from piping.dbo.spool t
		inner join piping.dbo.iso t3
		on t.plant_no = t3.plant_no and
		   t.area_no = t3.area_no and
		   t.drawing_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no and
		   t.rev_no = t3.rev_no
		inner join #ttCountEM t5
		on t3.plant_no = t5.plant_no and
		   t3.area_no = t5.area_no and
		   t3.drawing_no = t5.drawing_no and
		   t3.sheet_no = t5.sheet_no
		inner join #ttSPL t6
		on t.drawing_no = t6.drawing_no and
		   t.spool_no = t6.spool_no
		inner join (
			select plant_no, area_no, drawing_no, sheet_no, spool_no from piping.dbo.mat_takeoff_perspool where lower(spool_no) != ''em'' group by plant_no, area_no, drawing_no, sheet_no, spool_no
		) t4
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no
		where lower(t4.spool_no) != ''em'';
		   
	insert into #ttCountSPL
		select MAX(t.plant_no),
			   MAX(t.area_no),
			   max(t.drawing_no), 
			   max(t.sheet_no), 
			   max(t.spool_no),
			   0,
			   count(t5.drawing_no)
			from piping.dbo.spool t
			inner join piping.dbo.iso t3
			on t.plant_no = t3.plant_no and
			   t.area_no = t3.area_no and
			   t.drawing_no = t3.drawing_no and
			   t.sheet_no = t3.sheet_no and
			   t.rev_no = t3.rev_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no
			inner join qms_pip.dbo.twhse_mat_spl t5
			on t4.drawing_no = t5.drawing_no and
			   t4.sheet_no = t5.sheet_no
			inner join #ttSPL t6
			on t.drawing_no = t6.drawing_no and
			   t.spool_no = t6.spool_no
			where lower(t4.spool_no) != ''em''
			group by t4.drawing_no, t4.sheet_no, t4.spool_no;
		   
	insert into #ttCountSPL
		select MAX(t.plant_no),
			   MAX(t.area_no),
			   max(t.drawing_no), 
			   max(t.sheet_no), 
			   max(t.spool_no),
			   count(t5.drawing_no),
			   0
			from piping.dbo.spool t
			inner join piping.dbo.iso t3
			on t.plant_no = t3.plant_no and
			   t.area_no = t3.area_no and
			   t.drawing_no = t3.drawing_no and
			   t.sheet_no = t3.sheet_no and
			   t.rev_no = t3.rev_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no
			right outer join qms_pip.dbo.twhse_mat_spl t5
			on t4.drawing_no = t5.drawing_no and
			   t4.sheet_no = t5.sheet_no
			inner join #ttSPL t6
			on t.drawing_no = t6.drawing_no and
			   t.spool_no = t6.spool_no
			where lower(t4.spool_no) != ''em''
			group by t4.drawing_no, t4.sheet_no, t4.spool_no;
			   
	merge #ttCountEM as target
	using (select plant_no, area_no, drawing_no, sheet_no, spool_no, ref_rec_qty, qty from piping.dbo.mat_takeoff_perspool) as src
		  (plant_no, area_no, drawing_no, sheet_no, spool_no, ref_rec_qty, qty)
	on (target.plant_no = src.plant_no and
		target.area_no = src.area_no and
		target.drawing_no = src.drawing_no and
		target.sheet_no = src.sheet_no and
		target.spool_no = src.spool_no)
	when not matched then
		insert (plant_no, area_no, drawing_no, sheet_no, spool_no, icnt1_em, icnt2_em)
		values (src.plant_no, src.area_no, src.drawing_no, src.sheet_no, src.spool_no, (case when(src.ref_rec_qty < src.qty) then 1 else 0 end), (case when(src.ref_rec_qty >= src.qty) then 1 else 0 end))
	when matched then
		update set icnt1_em = (case when(src.ref_rec_qty < src.qty) then 1 else 0 end), 
				   icnt2_em = (case when(src.ref_rec_qty >= src.qty) then 1 else 0 end);
	 -- proc_iso_upd1
	 -- exec dbo.ttMTO_upd1_sp;
	if (exists(select top 1 * from qms_pip.dbo.twhse_mat_ps))
	begin	
		update t
			set t.reqd_qty = t2.rec_qty,
				t.ref_rec_qty = t2.rec_qty,
				t.ref_rec_date = (case when(t.ref_rec_qty >= t.iso_qty) then t2.ref_date else t.ref_rec_date end)
			from piping.dbo.ps_mto_hdr t
			inner join qms_pip.dbo.twhse_mat_ps t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type	
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no;
			   
		insert into #ttCountPS
			select max(t4.plant_no), 
				   max(t4.area_no), 
				   max(t.drawing_no), 
				   max(t4.sheet_no), 
				   max(t4.spool_no), 
				   max(t.ps_code), 
				   max(t.ps_type),
				   sum(case when(t.ref_rec_qty >= t.iso_qty) then 0 else 1 end),
				   sum(case when(t.ref_rec_qty >= t.iso_qty) then 1 else 0 end),
				   null
				from piping.dbo.ps_mto_hdr t
				inner join qms_pip.dbo.twhse_mat_ps t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.mat_takeoff_perspool t4
				on t3.plant_no = t4.plant_no and
				   t3.area_no = t4.area_no and
				   t3.drawing_no = t4.drawing_no and
				   t3.sheet_no = t4.sheet_no;
			   
		update t
			set t.ref_rec_no = (case when(t.ref_rec_no = '''') then t4.ref_no else(t.ref_rec_no + ''/'' + t4.ref_no) end),
				t.ref_rec_date = t4.ref_date,
				t.ref_rec_qty = t.wt_fab,
				t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.client_ref_no else(t.ref_iss_no + ''/'' + t4.client_ref_no) end)
			from piping.dbo.ps_mto t
			inner join piping.dbo.ps_mto_hdr t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type			
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			inner join qms_pip.dbo.twhse_mat_ps t4
			on t.drawing_no = t4.drawing_no and
			   t.ps_code = t4.ps_code and
			   t.ps_type = t4.ps_type
			inner join piping.dbo.mat_takeoff_perspool t5
			on t3.plant_no = t5.plant_no and
			   t3.area_no = t5.area_no and
			   t3.drawing_no = t5.drawing_no and
			   t3.sheet_no = t5.sheet_no;
			   
		update t set icnt1_ps = COUNT(t2.drawing_no)
			from #ttCountPS t
			inner join piping.dbo.ps_mto_hdr t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			right outer join qms_pip.dbo.twhse_mat_ps t4
			on t2.drawing_no = t4.drawing_no and
			   t2.ps_code = t4.ps_code and
			   t2.ps_type = t4.ps_type
			inner join piping.dbo.mat_takeoff_perspool t5
			on t3.plant_no = t5.plant_no and
			   t3.area_no = t5.area_no and
			   t3.drawing_no = t5.drawing_no and
			   t3.sheet_no = t5.sheet_no;
			   
		update t
			set t.ref_rec_no = (case when(t.ref_rec_no = '''') then (''JWRR-'' + t4.jmif_no) else(t.ref_rec_no + ''/JWRR-'' + t4.jmif_no) end),
				t.ref_rec_date = t4.issue_date,
				t.ref_rec_qty = t.wt_fab,
				t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.jmif_no else(t.ref_iss_no + ''/'' + t4.jmif_no) end)
			from piping.dbo.ps_mto t
			inner join piping.dbo.ps_mto_hdr t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			inner join piping.dbo.treqiss_dtl t4
			on t.drawing_no = t4.drawing_no and
			   t.ps_code = t4.stock_no and
			   t.ps_code = t4.item_code and
			   t.ps_code = t4.commodity_code and
			   t.mat_tag = t4.isc_no
			inner join piping.dbo.mat_takeoff_perspool t5
			on t3.plant_no = t5.plant_no and
			   t3.area_no = t5.area_no and
			   t3.drawing_no = t5.drawing_no and
			   t3.sheet_no = t5.sheet_no;
	end
	else
	begin
		if (exists(select top 1 * from qms_pip.dbo.twhse_mat_ps_ch))
		begin
			declare @cutoff_date as date
			set @cutoff_date = (select top 1 cutoff_date from qms_pip.dbo.twhse_mat_ps_ch);
			update t
				set reqd_qty = t3.rec_qty,
					ref_rec_qty = t3.rec_qty
				from piping.dbo.ps_mto_hdr t
				inner join piping.dbo.iso t2
				on t.drawing_no = t2.drawing_no
				inner join qms_pip.dbo.twhse_mat_ps_dtl t3
				on t.drawing_no = t3.drawing_no and
				   t.ps_code = t3.ps_code and
				   t.ps_type = t3.ps_type
				inner join piping.dbo.mat_takeoff_perspool t4
				on t3.plant_no = t4.plant_no and
				   t3.area_no = t4.area_no and
				   t3.drawing_no = t4.drawing_no and
				   t3.sheet_no = t4.sheet_no
				where t3.cutoff_date = @cutoff_date
				   
			insert into #ttCountPS
				select max(t4.plant_no), 
					   max(t4.area_no), 
					   max(t.drawing_no), 
					   max(t4.sheet_no), 
					   max(t4.spool_no), 
					   max(t.ps_code), 
					   max(t.ps_type),
					   sum(case when(t.ref_rec_qty >= t.iso_qty) then 1 else 0 end),
					   sum(case when(t.ref_rec_qty >= t.iso_qty) then 0 else 1 end),
					   max(t3.cutoff_date)
					from piping.dbo.ps_mto_hdr t
					inner join piping.dbo.iso t2
					on t.drawing_no = t2.drawing_no
					inner join qms_pip.dbo.twhse_mat_ps_dtl t3
					on t.drawing_no = t3.drawing_no and
					   t.ps_code = t3.ps_code and
					   t.ps_type = t3.ps_type
					inner join piping.dbo.mat_takeoff_perspool t4
					on t3.plant_no = t4.plant_no and
					   t3.area_no = t4.area_no and
					   t3.drawing_no = t4.drawing_no and
					   t3.sheet_no = t4.sheet_no
					where t3.cutoff_date = @cutoff_date;
				   
			update t
				set t.ref_rec_no = (case when(t.ref_rec_no = '''') then t4.ref_no else(t.ref_rec_no + ''/'' + t4.ref_no) end),
					t.ref_rec_date = t4.ref_date,
					t.ref_rec_qty = t.wt_fab,
					t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.client_ref_no else(t.ref_iss_no + ''/'' + t4.client_ref_no) end)
				from piping.dbo.ps_mto t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type			
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join qms_pip.dbo.twhse_mat_ps_dtl t4
				on t.drawing_no = t4.drawing_no and
				   t.ps_code = t4.ps_code and
				   t.ps_type = t4.ps_type
				inner join piping.dbo.mat_takeoff_perspool t5
				on t3.plant_no = t5.plant_no and
				   t3.area_no = t5.area_no and
				   t3.drawing_no = t5.drawing_no and
				   t3.sheet_no = t5.sheet_no
				where t4.cutoff_date = @cutoff_date;
				   
			update t set icnt1_ps = COUNT(t2.drawing_no)
				from #ttCountPS t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type	
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				right outer join qms_pip.dbo.twhse_mat_ps_dtl t4
				on t2.drawing_no = t4.drawing_no and
				   t2.ps_code = t4.ps_code and
				   t2.ps_type = t4.ps_type
				inner join piping.dbo.mat_takeoff_perspool t5
				on t3.plant_no = t5.plant_no and
				   t3.area_no = t5.area_no and
				   t3.drawing_no = t5.drawing_no and
				   t3.sheet_no = t5.sheet_no
				where t4.cutoff_date = @cutoff_date;
				   
			update t
				set t.ref_rec_no = (case when(t.ref_rec_no = '''') then (''JWRR-'' + t4.jmif_no) else(t.ref_rec_no + ''/JWRR-'' + t4.jmif_no) end),
					t.ref_rec_date = t4.issue_date,
					t.ref_rec_qty = t.wt_fab,
					t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.jmif_no else(t.ref_iss_no + ''/'' + t4.jmif_no) end)
				from piping.dbo.ps_mto t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.treqiss_dtl t4
				on t.drawing_no = t4.drawing_no and
				   t.ps_code = t4.stock_no and
				   t.ps_code = t4.item_code and
				   t.ps_code = t4.commodity_code and
				   t.mat_tag = t4.isc_no
				right outer join qms_pip.dbo.twhse_mat_ps_dtl t5
				on t2.drawing_no = t5.drawing_no and
				   t2.ps_code = t5.ps_code and
				   t2.ps_type = t5.ps_type
				inner join piping.dbo.mat_takeoff_perspool t6
				on t3.plant_no = t6.plant_no and
				   t3.area_no = t6.area_no and
				   t3.drawing_no = t6.drawing_no and
				   t3.sheet_no = t6.sheet_no
				where t5.cutoff_date = @cutoff_date;
		end
		else
		begin				   
			update t set icnt1_ps = 1 -- COUNT(t2.drawing_no)
				from #ttCountPS t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.mat_takeoff_perspool t4
				on t3.plant_no = t4.plant_no and
				   t3.area_no = t4.area_no and
				   t3.drawing_no = t4.drawing_no and
				   t3.sheet_no = t4.sheet_no;
				   
			update t
				set t.ref_rec_no = (case when(t.ref_rec_no = '''') then (''JWRR-'' + t4.jmif_no) else(t.ref_rec_no + ''/JWRR-'' + t4.jmif_no) end),
					t.ref_rec_date = t4.issue_date,
					t.ref_rec_qty = t.wt_fab,
					t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.jmif_no else(t.ref_iss_no + ''/'' + t4.jmif_no) end)
				from piping.dbo.ps_mto t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.treqiss_dtl t4
				on t.drawing_no = t4.drawing_no and
				   t.ps_code = t4.stock_no and
				   t.ps_code = t4.item_code and
				   t.ps_code = t4.commodity_code and
				   t.mat_tag = t4.isc_no
				inner join piping.dbo.mat_takeoff_perspool t5
				on t3.plant_no = t5.plant_no and
				   t3.area_no = t5.area_no and
				   t3.drawing_no = t5.drawing_no and
				   t3.sheet_no = t5.sheet_no;
		end
	end
	
	create table #ttPSH(
		drawing_no varchar(max),
		ps_code varchar(max),
		ps_type varchar(max),
		cnt_nc int,
		cnt_c int
	);
	
	merge #ttPSH as target
	using (select t.drawing_no, t.ps_code, t.ps_type, t.wt_fab, t.ref_rec_qty
				from piping.dbo.ps_mto t
				inner join piping.dbo.iso t2
				on t.drawing_no = t2.drawing_no) as src
		  (drawing_no, ps_code, ps_type, wt_fab, ref_rec_qty)
	on (target.drawing_no = src.drawing_no and
	    target.ps_code = src.ps_code and
	    target.ps_type = src.ps_type)
	when not matched then
		insert (drawing_no, ps_code, ps_type, cnt_nc, cnt_c)
		values (src.drawing_no, src.ps_code, src.ps_type, (case when(src.wt_fab != 0 AND src.ref_rec_qty < src.wt_fab) then 1 else 0 end), (case when(src.wt_fab != 0 AND src.ref_rec_qty >= src.wt_fab) then 1 else 0 end))
	when matched then
		update set cnt_nc = (case when(src.wt_fab != 0 AND src.ref_rec_qty < src.wt_fab) then 1 else 0 end), 
				   cnt_c = (case when(src.wt_fab != 0 AND src.ref_rec_qty >= src.wt_fab) then 1 else 0 end);

	update top (1) t set percent_workable = t2.cnt_c / ((t2.cnt_nc + t2.cnt_c) * 100)
		from piping.dbo.ps_mto_hdr t
		inner join #ttPSH t2
		on t.drawing_no = t2.drawing_no and
		   t.ps_code = t2.ps_code and
		   t.ps_type = t2.ps_type
		inner join piping.dbo.iso t3
		on t2.drawing_no = t3.drawing_no;

	update top (1) t
		set percent_workable = (
			(case when((t4.icnt1_em + t4.icnt2_em) != 0) then(t4.icnt2_em / ((t4.icnt1_em + t4.icnt2_em) * 100)) else 0 end) +
			(case when((t2.icnt1_spl + t2.icnt2_spl) != 0) then(t2.icnt2_spl / ((t2.icnt1_spl + t2.icnt2_spl) * 100)) else 0 end) +
			(case when((t3.icnt1_ps + t3.icnt2_ps) != 0) then(t3.icnt2_ps / ((t3.icnt1_ps + t3.icnt2_ps) * 100)) else 0 end)
		) / 3
		from piping.dbo.iso t
		inner join #ttCountSpl t2
		on t.plant_no = t2.plant_no and
		   t.area_no = t2.area_no and
		   t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no
		inner join #ttCountPS t3
		on t.plant_no = t3.plant_no and
		   t.area_no = t3.area_no and
		   t.drawing_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no
		inner join #ttCountEM t4
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no and
		   t3.spool_no = t4.spool_no
		inner join piping.dbo.mat_takeoff_perspool t5
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no and
		   t3.spool_no = t4.spool_no
		where (t2.icnt1_spl + icnt2_spl) != 0 and
		      (t3.icnt1_ps + t3.icnt2_ps) != 0 and
		      lower(t5.spool_no) = ''em'';
		      
	update top (1) t
		set percent_workable = (
			(case when((t4.icnt1_em + t4.icnt2_em) != 0) then(t4.icnt2_em / ((t4.icnt1_em + t4.icnt2_em) * 100)) else 0 end) +
			(case when((t2.icnt1_spl + t2.icnt2_spl) != 0) then(t2.icnt2_spl / ((t2.icnt1_spl + t2.icnt2_spl) * 100)) else 0 end)
		) / 2
		from piping.dbo.iso t
		inner join #ttCountSpl t2
		on t.plant_no = t2.plant_no and
		   t.area_no = t2.area_no and
		   t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no
		inner join #ttCountPS t3
		on t2.plant_no = t3.plant_no and
		   t2.area_no = t3.area_no and
		   t2.drawing_no = t3.drawing_no and
		   t2.sheet_no = t3.sheet_no and
		   t2.spool_no = t3.spool_no
		inner join #ttCountEM t4
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no and
		   t3.spool_no = t4.spool_no
		inner join piping.dbo.mat_takeoff_perspool t5
		on t4.plant_no = t5.plant_no and
		   t4.area_no = t5.area_no and
		   t4.drawing_no = t5.drawing_no and
		   t4.sheet_no = t5.sheet_no and
		   t4.spool_no = t5.spool_no
		where (t2.icnt1_spl + icnt2_spl) != 0 and
		      (t3.icnt1_ps + t3.icnt2_ps) = 0 and
		      lower(t5.spool_no) = ''em'';
		      
	update top (1) t
		set percent_workable = (case when((t4.icnt1_em + t4.icnt2_em) != 0) then(t4.icnt2_em / ((t4.icnt1_em + t4.icnt2_em) * 100)) else 0 end)
		from piping.dbo.iso t
		inner join #ttCountSpl t2
		on t.plant_no = t2.plant_no and
		   t.area_no = t2.area_no and
		   t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no
		inner join #ttCountPS t3
		on t2.plant_no = t3.plant_no and
		   t2.area_no = t3.area_no and
		   t2.drawing_no = t3.drawing_no and
		   t2.sheet_no = t3.sheet_no and
		   t2.spool_no = t3.spool_no
		inner join #ttCountEM t4
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no and
		   t3.spool_no = t4.spool_no
		inner join piping.dbo.mat_takeoff_perspool t5
		on t4.plant_no = t5.plant_no and
		   t4.area_no = t5.area_no and
		   t4.drawing_no = t5.drawing_no and
		   t4.sheet_no = t5.sheet_no and
		   t4.spool_no = t5.spool_no
		where (t2.icnt1_spl + icnt2_spl) = 0 and
		      (t3.icnt1_ps + t3.icnt2_ps) = 0 and
		      lower(t5.spool_no) = ''em'';

	delete from tempdb_sql.dbo.ttMTO where loguser = @ip_loguser;
	delete from tempdb_sql.dbo.ttMTO1 where loguser = @ip_loguser;

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
/****** Object:  StoredProcedure [dbo].[ttMTO_ps_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[ttMTO_ps_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[ttMTO_ps_sp]
	@ip_refrecno varchar(max),
	@ip_refrecdate date,
	@ip_suppcode varchar(max),
	@ip_suppdesc varchar(max),
	@ip_prpono varchar(max),
	@ip_pldninv varchar(max),
	@ip_recby varchar(max),
	@ip_recdate date,
	@ip_qcmrirno varchar(max),
	@ip_qcmrirdate date,
	@ip_rfino varchar(max),
	@ip_rfidate date,
	@ip_refissno varchar(max),
	@ip_refrem varchar(max),
	@ip_loguser varchar(max),
	@ip_precid varchar(max)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	BEGIN TRANSACTION;
	
	IF OBJECT_ID(''tempdb...#ttCountPS'') IS NOT NULL
	BEGIN
		DROP TABLE #ttCountPS
	END
	create table #ttCountPS (
		plant_no varchar(max),
		area_no varchar(max),
		drawing_no varchar(max),
		sheet_no varchar(max),
		spool_no varchar(max),
		ps_code varchar(max),
		ps_type varchar(max),
		icnt1_ps int,
		icnt2_ps int,
		cutoff_date date
	)
	
	IF OBJECT_ID(''tempdb...#ttCountSpl'') IS NOT NULL
	BEGIN
		DROP TABLE #ttCountSpl
	END
	create table #ttCountSpl (
		plant_no varchar(max),
		area_no varchar(max),
		drawing_no varchar(max),
		sheet_no varchar(max),
		spool_no varchar(max),
		icnt1_spl int,
		icnt2_spl int
	)
	
	IF OBJECT_ID(''tempdb...#ttCountEM'') IS NOT NULL
	BEGIN
		DROP TABLE #ttCountEM
	END
	create table #ttCountEM(
		plant_no varchar(max),
		area_no varchar(max),
		drawing_no varchar(max),
		sheet_no varchar(max),
		spool_no varchar(max),
		icnt1_em int,
		icnt2_em int
	);
	
	IF OBJECT_ID(''tempdb...#ttISO'') IS NOT NULL
	BEGIN
		DROP TABLE #ttISO
	END
	create table #ttISO(
		drawing_no varchar(max),
		sheet_no varchar(max)
	);
	
	insert into piping.dbo.tjwrr_hdr(jwrr_no, disc_code, disc_desc, log_user, log_date, log_time, jwrr_date, supp_code, supp_desc, pr_po_no, pl_dn_inv, rcvd_by, rcvd_date, qcmrir_no, qcmrir_date, rfi_no, rfi_date, jmif_no, remarks, log_update)
		values(@ip_refrecno, ''PS'', ''PIPE SUPPORT'', ''UPLOAD BY'' + @ip_loguser, {fn NOW()}, convert(time,CURRENT_TIMESTAMP), @ip_refrecdate, @ip_suppcode, @ip_suppdesc, @ip_prpono, @ip_pldninv, @ip_recby, @ip_recdate, @ip_qcmrirno, @ip_qcmrirdate, @ip_rfino, @ip_rfidate, @ip_refissno, @ip_refrem, (@ip_loguser + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))));
			
	declare @drawing_no varchar(max)
	declare @sheet_no varchar(max)
	declare @rec_qty decimal(17,2)
	declare @ps_code varchar(max)
	declare @ps_matl varchar(max)
	declare @ps_specs varchar(max)
	declare @ps_class varchar(max)
	declare @category varchar(max)
	declare @um varchar(max)
	declare @line_size varchar(max)
	declare @area_no varchar(max)
	declare @rev_no varchar(max)
	declare @dtl_rem varchar(max)
	declare @ps_type varchar(max)
	declare @PROGRESS_RECID bigint
	declare crs cursor read_only
		for select drawing_no, sheet_no, rec_qty, ps_code, ps_matl, ps_specs, ps_class, category, um, line_size, area_no, rev_no, dtl_rem, ps_type, PROGRESS_RECID from tempdb_sql.dbo.ttmto where convert(varchar,PROGRESS_RECID) in (@ip_precid)
			
	open crs
	fetch next from crs into @drawing_no, @sheet_no, @rec_qty, @ps_code, @ps_matl, @ps_specs, @ps_class, @category, @um, @line_size, @area_no, @rev_no, @dtl_rem, @ps_type, @PROGRESS_RECID
	while @@FETCH_STATUS = 0
	begin

		insert into #ttISO	
			select drawing_no, sheet_no
				from piping.dbo.ps_mto where PROGRESS_RECID = @PROGRESS_RECID group by drawing_no, sheet_no
			
		update t
			set ref_rec_no = case when(ref_rec_no = '''') then @ip_refrecno else(ref_rec_no + ''/'' + @ip_refrecno) end,
				ref_rec_date = @ip_refrecdate,
				ref_rec_qty = ref_rec_qty + @rec_qty,
				ref_iss_no = case when(ref_iss_no = '''') then @ip_refissno else(ref_iss_no + ''/'' + @ip_refissno) end
			from piping.dbo.ps_mto t where PROGRESS_RECID = @PROGRESS_RECID				
		
		insert into piping.dbo.tjwrr_dtl(jwrr_no, stock_no, stock_desc, item_code, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, remarks, jmif_no, disc_code, rcvd_date, log_user, log_date, jwrr_qty, log_update)
			values(@ip_refrecno, @ps_code, @ps_matl + '' PS Spec: '' + @ps_specs + '' PS Code: '' + @ps_code + '' PS Class: '' + @ps_class + '' Category: '' + @category, 
				   @ps_code, @ps_code, @um, @line_size, @area_no, @drawing_no, @sheet_no, @rev_no, @dtl_rem, @ip_refissno, ''PS'', @ip_recdate, ''UPLOADED BY '' + @ip_loguser, {fn NOW()}, @rec_qty, (@ip_loguser + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))));
		
		merge piping.dbo.material_file as target
		using (select @ps_code, @line_size, @ps_class, @um, @ps_matl, @ps_type, @category) as src
			  (ps_code, line_size, ps_class, um, ps_matl, ps_type, category)
		on (target.stock_no = src.ps_code and
			target.item_code = src.ps_code and
			target.commodity_code = src.ps_code and
			target.size = src.line_size and
			target.mat_type = src.ps_class
		   )
		when not matched then
			insert (stock_no, item_code, commodity_code, size, mat_type, item, uom, description, flg_status)
			values (src.ps_code, src.ps_code, src.ps_code, src.line_size, src.ps_class, src.ps_class, src.um, src.ps_matl + '' SuppCode: '' + src.ps_code + '' TYPE/FIG: '' + src.ps_type + '' SuppClass: '' + src.ps_class + '' Category: '' + src.category, 1);
			
		merge piping.dbo.material_file_dtl as target
		using (select @ps_code) as src (ps_code)
		on (target.stock_no = src.ps_code and
			target.item_code = src.ps_code and
			target.commodity_code = src.ps_code and
			target.disc_code = ''PS''
		   )
		when not matched then
			insert (stock_no, item_code, commodity_code, disc_code, flg_status)
			values (src.ps_code, src.ps_code, src.ps_code, ''PS'', 1);
		
		fetch next from crs into @drawing_no, @sheet_no, @rec_qty, @ps_code, @ps_matl, @ps_specs, @ps_class, @category, @um, @line_size, @area_no, @rev_no, @dtl_rem, @ps_type, @PROGRESS_RECID
	end
	close crs
	deallocate crs
	
	-- proc_iso_upd
	
	--declare @icnt1_em int;
	--declare @icnt2_em int;
	--select @icnt1_em = sum(case when(t.ref_rec_qty < t.qty) then 1 else 0 end),
	--	   @icnt2_em = sum(case when(t.ref_rec_qty >= t.qty) then 1 else 0 end) 
	--	from piping.dbo.mat_takeoff_perspool t
	--	inner join #ttISO t2
	--	on t.drawing_no = t2.drawing_no and
	--	   t.sheet_no = t2.sheet_no
	--	where lower(t.spool_no) = ''em''
	--	group by t.drawing_no, t.sheet_no, t.spool_no;
	
	insert into #ttCountEM
		select MAX(t.plant_no) as plant_no,
			   MAX(t.area_no) as area_no,
			   t.drawing_no, 
			   t.sheet_no, 
			   t.spool_no,
			   sum(case when(t.ref_rec_qty < t.qty) then 1 else 0 end),
			   sum(case when(t.ref_rec_qty >= t.qty) then 1 else 0 end)
			from piping.dbo.mat_takeoff_perspool t
			inner join #ttISO t2
			on t.drawing_no = t2.drawing_no and
			   t.sheet_no = t2.sheet_no
			where lower(t.spool_no) = ''em''
			group by t.drawing_no, t.sheet_no, t.spool_no;

	IF OBJECT_ID(''tempdb...#ttSPL'') IS NOT NULL
	BEGIN
		DROP TABLE #ttSPL
	END
	create table #ttSPL(
		drawing_no varchar(max),
		spool_no varchar(max),
		cnt_c int,
		cnt_nc int
	);
	
	merge #ttSPL as target
	using (select t.drawing_no, spool_no from piping.dbo.mat_takeoff_perspool t
		inner join #ttISO t2
		on t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no
		where lower(t.spool_no) != ''em'' and
			  t.ref_rec_qty < t.qty
		group by t.drawing_no, t.sheet_no, t.spool_no) as src
		(drawing_no, spool_no)
	on (target.drawing_no = src.drawing_no and
		target.spool_no = src.spool_no)
	when not matched then
		insert (drawing_no, spool_no, cnt_nc)
		values (src.drawing_no, src.spool_no, 1)
	when matched then
		update set cnt_nc = cnt_nc + 1;
	
	merge #ttSPL as target
	using (select t.drawing_no, spool_no from piping.dbo.mat_takeoff_perspool t
		inner join #ttISO t2
		on t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no
		where lower(t.spool_no) != ''em'' and
			  t.ref_rec_qty >= t.qty
		group by t.drawing_no, t.sheet_no, t.spool_no) as src
		(drawing_no, spool_no)
	on (target.drawing_no = src.drawing_no and
		target.spool_no = src.spool_no)
	when not matched then
		insert (drawing_no, spool_no, cnt_c)
		values (src.drawing_no, src.spool_no, 1)
	when matched then
		update set cnt_c = cnt_c + 1;

	update t
		set t.ref_rec_date = (case when(lower(t.spool_no) != ''em'') then(select t2.ref_date from qms_pip.dbo.twhse_mat_spl t2 where t2.drawing_no = t.drawing_no and t2.spool_no = t.spool_no) else t.ref_rec_date end),
			t.ref_rec_qty = (case when(lower(t.spool_no) != ''em'') then(select 1 from qms_pip.dbo.twhse_mat_spl t2 where t2.drawing_no = t.drawing_no and t2.spool_no = t.spool_no) else t.ref_rec_qty end),
			t.percent_workable = (case when((t5.icnt1_em + t5.icnt2_em) != 0) then((t5.icnt2_em / (t5.icnt1_em + t5.icnt2_em)) * 100) else 0 end)
		from piping.dbo.spool t
		inner join piping.dbo.iso t3
		on t.plant_no = t3.plant_no and
		   t.area_no = t3.area_no and
		   t.drawing_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no and
		   t.rev_no = t3.rev_no
		inner join #ttCountEM t5
		on t3.plant_no = t5.plant_no and
		   t3.area_no = t5.area_no and
		   t3.drawing_no = t5.drawing_no and
		   t3.sheet_no = t5.sheet_no
		inner join (
			select plant_no, area_no, drawing_no, sheet_no, spool_no from piping.dbo.mat_takeoff_perspool group by plant_no, area_no, drawing_no, sheet_no, spool_no
		) t4
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no
		where lower(t4.spool_no) = ''em'';
		   
	insert into #ttCountSPL
		select MAX(t.plant_no),
			   MAX(t.area_no),
			   max(t.drawing_no), 
			   max(t.sheet_no), 
			   max(t.spool_no),
			   0 as ict1_spl,
			   count(t5.drawing_no)
			from piping.dbo.spool t
			inner join piping.dbo.iso t3
			on t.plant_no = t3.plant_no and
			   t.area_no = t3.area_no and
			   t.drawing_no = t3.drawing_no and
			   t.sheet_no = t3.sheet_no and
			   t.rev_no = t3.rev_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no
			inner join qms_pip.dbo.twhse_mat_spl t5
			on t4.drawing_no = t5.drawing_no and
			   t4.sheet_no = t5.sheet_no
			where lower(t4.spool_no) = ''em''
			group by t4.drawing_no, t4.sheet_no, t4.spool_no;
		   
	insert into #ttCountSPL
		select MAX(t.plant_no),
			   MAX(t.area_no),
			   max(t.drawing_no), 
			   max(t.sheet_no), 
			   max(t.spool_no),
			   count(t5.drawing_no),
			   0
			from piping.dbo.spool t
			inner join piping.dbo.iso t3
			on t.plant_no = t3.plant_no and
			   t.area_no = t3.area_no and
			   t.drawing_no = t3.drawing_no and
			   t.sheet_no = t3.sheet_no and
			   t.rev_no = t3.rev_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no
			right outer join qms_pip.dbo.twhse_mat_spl t5
			on t4.drawing_no = t5.drawing_no and
			   t4.sheet_no = t5.sheet_no
			where lower(t4.spool_no) = ''em''
			group by t4.drawing_no, t4.sheet_no, t4.spool_no;
			   
	update t
		set ref_rec_date = (case when(lower(t.spool_no) != ''em'') then(select ref_date from qms_pip.dbo.twhse_mat_spl t2 where t2.drawing_no = t.drawing_no and t2.spool_no = t.spool_no) else t.ref_rec_date end),
			ref_rec_qty = (case when(lower(t.spool_no) != ''em'') then(select 1 from qms_pip.dbo.twhse_mat_spl t2 where t2.drawing_no = t.drawing_no and t2.spool_no = t.spool_no) else t.ref_rec_qty end),
			percent_workable = (case when((t6.cnt_nc + t6.cnt_c) != 0) then((t6.cnt_c / (t6.cnt_nc + t6.cnt_c)) * 100) else 0 end)
		from piping.dbo.spool t
		inner join piping.dbo.iso t3
		on t.plant_no = t3.plant_no and
		   t.area_no = t3.area_no and
		   t.drawing_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no and
		   t.rev_no = t3.rev_no
		inner join #ttCountEM t5
		on t3.plant_no = t5.plant_no and
		   t3.area_no = t5.area_no and
		   t3.drawing_no = t5.drawing_no and
		   t3.sheet_no = t5.sheet_no
		inner join #ttSPL t6
		on t.drawing_no = t6.drawing_no and
		   t.spool_no = t6.spool_no
		inner join (
			select plant_no, area_no, drawing_no, sheet_no, spool_no from piping.dbo.mat_takeoff_perspool where lower(spool_no) != ''em'' group by plant_no, area_no, drawing_no, sheet_no, spool_no
		) t4
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no
		where lower(t4.spool_no) != ''em'';
		   
	insert into #ttCountSPL
		select MAX(t.plant_no),
			   MAX(t.area_no),
			   max(t.drawing_no), 
			   max(t.sheet_no), 
			   max(t.spool_no),
			   0,
			   count(t5.drawing_no)
			from piping.dbo.spool t
			inner join piping.dbo.iso t3
			on t.plant_no = t3.plant_no and
			   t.area_no = t3.area_no and
			   t.drawing_no = t3.drawing_no and
			   t.sheet_no = t3.sheet_no and
			   t.rev_no = t3.rev_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no
			inner join qms_pip.dbo.twhse_mat_spl t5
			on t4.drawing_no = t5.drawing_no and
			   t4.sheet_no = t5.sheet_no
			inner join #ttSPL t6
			on t.drawing_no = t6.drawing_no and
			   t.spool_no = t6.spool_no
			where lower(t4.spool_no) != ''em''
			group by t4.drawing_no, t4.sheet_no, t4.spool_no;
		   
	insert into #ttCountSPL
		select MAX(t.plant_no),
			   MAX(t.area_no),
			   max(t.drawing_no), 
			   max(t.sheet_no), 
			   max(t.spool_no),
			   count(t5.drawing_no),
			   0
			from piping.dbo.spool t
			inner join piping.dbo.iso t3
			on t.plant_no = t3.plant_no and
			   t.area_no = t3.area_no and
			   t.drawing_no = t3.drawing_no and
			   t.sheet_no = t3.sheet_no and
			   t.rev_no = t3.rev_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no
			right outer join qms_pip.dbo.twhse_mat_spl t5
			on t4.drawing_no = t5.drawing_no and
			   t4.sheet_no = t5.sheet_no
			inner join #ttSPL t6
			on t.drawing_no = t6.drawing_no and
			   t.spool_no = t6.spool_no
			where lower(t4.spool_no) != ''em''
			group by t4.drawing_no, t4.sheet_no, t4.spool_no;
			   
	merge #ttCountEM as target
	using (select plant_no, area_no, drawing_no, sheet_no, spool_no, ref_rec_qty, qty from piping.dbo.mat_takeoff_perspool) as src
		  (plant_no, area_no, drawing_no, sheet_no, spool_no, ref_rec_qty, qty)
	on (target.plant_no = src.plant_no and
		target.area_no = src.area_no and
		target.drawing_no = src.drawing_no and
		target.sheet_no = src.sheet_no and
		target.spool_no = src.spool_no)
	when not matched then
		insert (plant_no, area_no, drawing_no, sheet_no, spool_no, icnt1_em, icnt2_em)
		values (src.plant_no, src.area_no, src.drawing_no, src.sheet_no, src.spool_no, (case when(src.ref_rec_qty < src.qty) then 1 else 0 end), (case when(src.ref_rec_qty >= src.qty) then 1 else 0 end))
	when matched then
		update set icnt1_em = (case when(src.ref_rec_qty < src.qty) then 1 else 0 end), 
				   icnt2_em = (case when(src.ref_rec_qty >= src.qty) then 1 else 0 end);
	 -- proc_iso_upd1
	 -- exec dbo.ttMTO_upd1_sp;
	if (exists(select top 1 * from qms_pip.dbo.twhse_mat_ps))
	begin	
		update t
			set t.reqd_qty = t2.rec_qty,
				t.ref_rec_qty = t2.rec_qty,
				t.ref_rec_date = (case when(t.ref_rec_qty >= t.iso_qty) then t2.ref_date else t.ref_rec_date end)
			from piping.dbo.ps_mto_hdr t
			inner join qms_pip.dbo.twhse_mat_ps t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type	
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			inner join piping.dbo.mat_takeoff_perspool t4
			on t3.plant_no = t4.plant_no and
			   t3.area_no = t4.area_no and
			   t3.drawing_no = t4.drawing_no and
			   t3.sheet_no = t4.sheet_no;
			   
		insert into #ttCountPS
			select max(t4.plant_no), 
				   max(t4.area_no), 
				   max(t.drawing_no), 
				   max(t4.sheet_no), 
				   max(t4.spool_no), 
				   max(t.ps_code), 
				   max(t.ps_type),
				   sum(case when(t.ref_rec_qty >= t.iso_qty) then 0 else 1 end),
				   sum(case when(t.ref_rec_qty >= t.iso_qty) then 1 else 0 end),
				   null
				from piping.dbo.ps_mto_hdr t
				inner join qms_pip.dbo.twhse_mat_ps t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.mat_takeoff_perspool t4
				on t3.plant_no = t4.plant_no and
				   t3.area_no = t4.area_no and
				   t3.drawing_no = t4.drawing_no and
				   t3.sheet_no = t4.sheet_no;
			   
		update t
			set t.ref_rec_no = (case when(t.ref_rec_no = '''') then t4.ref_no else(t.ref_rec_no + ''/'' + t4.ref_no) end),
				t.ref_rec_date = t4.ref_date,
				t.ref_rec_qty = t.wt_fab,
				t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.client_ref_no else(t.ref_iss_no + ''/'' + t4.client_ref_no) end)
			from piping.dbo.ps_mto t
			inner join piping.dbo.ps_mto_hdr t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type			
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			inner join qms_pip.dbo.twhse_mat_ps t4
			on t.drawing_no = t4.drawing_no and
			   t.ps_code = t4.ps_code and
			   t.ps_type = t4.ps_type
			inner join piping.dbo.mat_takeoff_perspool t5
			on t3.plant_no = t5.plant_no and
			   t3.area_no = t5.area_no and
			   t3.drawing_no = t5.drawing_no and
			   t3.sheet_no = t5.sheet_no;
			   
		update t set icnt1_ps = COUNT(t2.drawing_no)
			from #ttCountPS t
			inner join piping.dbo.ps_mto_hdr t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			right outer join qms_pip.dbo.twhse_mat_ps t4
			on t2.drawing_no = t4.drawing_no and
			   t2.ps_code = t4.ps_code and
			   t2.ps_type = t4.ps_type
			inner join piping.dbo.mat_takeoff_perspool t5
			on t3.plant_no = t5.plant_no and
			   t3.area_no = t5.area_no and
			   t3.drawing_no = t5.drawing_no and
			   t3.sheet_no = t5.sheet_no;
			   
		update t
			set t.ref_rec_no = (case when(t.ref_rec_no = '''') then (''JWRR-'' + t4.jmif_no) else(t.ref_rec_no + ''/JWRR-'' + t4.jmif_no) end),
				t.ref_rec_date = t4.issue_date,
				t.ref_rec_qty = t.wt_fab,
				t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.jmif_no else(t.ref_iss_no + ''/'' + t4.jmif_no) end)
			from piping.dbo.ps_mto t
			inner join piping.dbo.ps_mto_hdr t2
			on t.drawing_no = t2.drawing_no and
			   t.ps_code = t2.ps_code and
			   t.ps_type = t2.ps_type
			inner join piping.dbo.iso t3
			on t2.drawing_no = t3.drawing_no
			inner join piping.dbo.treqiss_dtl t4
			on t.drawing_no = t4.drawing_no and
			   t.ps_code = t4.stock_no and
			   t.ps_code = t4.item_code and
			   t.ps_code = t4.commodity_code and
			   t.mat_tag = t4.isc_no
			inner join piping.dbo.mat_takeoff_perspool t5
			on t3.plant_no = t5.plant_no and
			   t3.area_no = t5.area_no and
			   t3.drawing_no = t5.drawing_no and
			   t3.sheet_no = t5.sheet_no;
	end
	else
	begin
		if (exists(select top 1 * from qms_pip.dbo.twhse_mat_ps_ch))
		begin
			declare @cutoff_date as date
			set @cutoff_date = (select top 1 cutoff_date from qms_pip.dbo.twhse_mat_ps_ch);
			update t
				set reqd_qty = t3.rec_qty,
					ref_rec_qty = t3.rec_qty
				from piping.dbo.ps_mto_hdr t
				inner join piping.dbo.iso t2
				on t.drawing_no = t2.drawing_no
				inner join qms_pip.dbo.twhse_mat_ps_dtl t3
				on t.drawing_no = t3.drawing_no and
				   t.ps_code = t3.ps_code and
				   t.ps_type = t3.ps_type
				inner join piping.dbo.mat_takeoff_perspool t4
				on t3.plant_no = t4.plant_no and
				   t3.area_no = t4.area_no and
				   t3.drawing_no = t4.drawing_no and
				   t3.sheet_no = t4.sheet_no
				where t3.cutoff_date = @cutoff_date
				   
			insert into #ttCountPS
				select max(t4.plant_no), 
					   max(t4.area_no), 
					   max(t.drawing_no), 
					   max(t4.sheet_no), 
					   max(t4.spool_no), 
					   max(t.ps_code), 
					   max(t.ps_type),
					   sum(case when(t.ref_rec_qty >= t.iso_qty) then 1 else 0 end),
					   sum(case when(t.ref_rec_qty >= t.iso_qty) then 0 else 1 end),
					   max(t3.cutoff_date)
					from piping.dbo.ps_mto_hdr t
					inner join piping.dbo.iso t2
					on t.drawing_no = t2.drawing_no
					inner join qms_pip.dbo.twhse_mat_ps_dtl t3
					on t.drawing_no = t3.drawing_no and
					   t.ps_code = t3.ps_code and
					   t.ps_type = t3.ps_type
					inner join piping.dbo.mat_takeoff_perspool t4
					on t3.plant_no = t4.plant_no and
					   t3.area_no = t4.area_no and
					   t3.drawing_no = t4.drawing_no and
					   t3.sheet_no = t4.sheet_no
					where t3.cutoff_date = @cutoff_date;
				   
			update t
				set t.ref_rec_no = (case when(t.ref_rec_no = '''') then t4.ref_no else(t.ref_rec_no + ''/'' + t4.ref_no) end),
					t.ref_rec_date = t4.ref_date,
					t.ref_rec_qty = t.wt_fab,
					t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.client_ref_no else(t.ref_iss_no + ''/'' + t4.client_ref_no) end)
				from piping.dbo.ps_mto t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type			
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join qms_pip.dbo.twhse_mat_ps_dtl t4
				on t.drawing_no = t4.drawing_no and
				   t.ps_code = t4.ps_code and
				   t.ps_type = t4.ps_type
				inner join piping.dbo.mat_takeoff_perspool t5
				on t3.plant_no = t5.plant_no and
				   t3.area_no = t5.area_no and
				   t3.drawing_no = t5.drawing_no and
				   t3.sheet_no = t5.sheet_no
				where t4.cutoff_date = @cutoff_date;
				   
			update t set icnt1_ps = COUNT(t2.drawing_no)
				from #ttCountPS t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type	
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				right outer join qms_pip.dbo.twhse_mat_ps_dtl t4
				on t2.drawing_no = t4.drawing_no and
				   t2.ps_code = t4.ps_code and
				   t2.ps_type = t4.ps_type
				inner join piping.dbo.mat_takeoff_perspool t5
				on t3.plant_no = t5.plant_no and
				   t3.area_no = t5.area_no and
				   t3.drawing_no = t5.drawing_no and
				   t3.sheet_no = t5.sheet_no
				where t4.cutoff_date = @cutoff_date;
				   
			update t
				set t.ref_rec_no = (case when(t.ref_rec_no = '''') then (''JWRR-'' + t4.jmif_no) else(t.ref_rec_no + ''/JWRR-'' + t4.jmif_no) end),
					t.ref_rec_date = t4.issue_date,
					t.ref_rec_qty = t.wt_fab,
					t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.jmif_no else(t.ref_iss_no + ''/'' + t4.jmif_no) end)
				from piping.dbo.ps_mto t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.treqiss_dtl t4
				on t.drawing_no = t4.drawing_no and
				   t.ps_code = t4.stock_no and
				   t.ps_code = t4.item_code and
				   t.ps_code = t4.commodity_code and
				   t.mat_tag = t4.isc_no
				right outer join qms_pip.dbo.twhse_mat_ps_dtl t5
				on t2.drawing_no = t5.drawing_no and
				   t2.ps_code = t5.ps_code and
				   t2.ps_type = t5.ps_type
				inner join piping.dbo.mat_takeoff_perspool t6
				on t3.plant_no = t6.plant_no and
				   t3.area_no = t6.area_no and
				   t3.drawing_no = t6.drawing_no and
				   t3.sheet_no = t6.sheet_no
				where t5.cutoff_date = @cutoff_date;
		end
		else
		begin				   
			update t set icnt1_ps = 1 -- COUNT(t2.drawing_no)
				from #ttCountPS t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.mat_takeoff_perspool t4
				on t3.plant_no = t4.plant_no and
				   t3.area_no = t4.area_no and
				   t3.drawing_no = t4.drawing_no and
				   t3.sheet_no = t4.sheet_no;
				   
			update t
				set t.ref_rec_no = (case when(t.ref_rec_no = '''') then (''JWRR-'' + t4.jmif_no) else(t.ref_rec_no + ''/JWRR-'' + t4.jmif_no) end),
					t.ref_rec_date = t4.issue_date,
					t.ref_rec_qty = t.wt_fab,
					t.ref_iss_no = (case when(t.ref_iss_no = '''') then t4.jmif_no else(t.ref_iss_no + ''/'' + t4.jmif_no) end)
				from piping.dbo.ps_mto t
				inner join piping.dbo.ps_mto_hdr t2
				on t.drawing_no = t2.drawing_no and
				   t.ps_code = t2.ps_code and
				   t.ps_type = t2.ps_type
				inner join piping.dbo.iso t3
				on t2.drawing_no = t3.drawing_no
				inner join piping.dbo.treqiss_dtl t4
				on t.drawing_no = t4.drawing_no and
				   t.ps_code = t4.stock_no and
				   t.ps_code = t4.item_code and
				   t.ps_code = t4.commodity_code and
				   t.mat_tag = t4.isc_no
				inner join piping.dbo.mat_takeoff_perspool t5
				on t3.plant_no = t5.plant_no and
				   t3.area_no = t5.area_no and
				   t3.drawing_no = t5.drawing_no and
				   t3.sheet_no = t5.sheet_no;
		end
	end
	
	create table #ttPSH(
		drawing_no varchar(max),
		ps_code varchar(max),
		ps_type varchar(max),
		cnt_nc int,
		cnt_c int
	);
	
	merge #ttPSH as target
	using (select t.drawing_no, t.ps_code, t.ps_type, t.wt_fab, t.ref_rec_qty
				from piping.dbo.ps_mto t
				inner join piping.dbo.iso t2
				on t.drawing_no = t2.drawing_no) as src
		  (drawing_no, ps_code, ps_type, wt_fab, ref_rec_qty)
	on (target.drawing_no = src.drawing_no and
	    target.ps_code = src.ps_code and
	    target.ps_type = src.ps_type)
	when not matched then
		insert (drawing_no, ps_code, ps_type, cnt_nc, cnt_c)
		values (src.drawing_no, src.ps_code, src.ps_type, (case when(src.wt_fab != 0 AND src.ref_rec_qty < src.wt_fab) then 1 else 0 end), (case when(src.wt_fab != 0 AND src.ref_rec_qty >= src.wt_fab) then 1 else 0 end))
	when matched then
		update set cnt_nc = (case when(src.wt_fab != 0 AND src.ref_rec_qty < src.wt_fab) then 1 else 0 end), 
				   cnt_c = (case when(src.wt_fab != 0 AND src.ref_rec_qty >= src.wt_fab) then 1 else 0 end);

	update top (1) t set percent_workable = t2.cnt_c / ((t2.cnt_nc + t2.cnt_c) * 100)
		from piping.dbo.ps_mto_hdr t
		inner join #ttPSH t2
		on t.drawing_no = t2.drawing_no and
		   t.ps_code = t2.ps_code and
		   t.ps_type = t2.ps_type
		inner join piping.dbo.iso t3
		on t2.drawing_no = t3.drawing_no;

	update top (1) t
		set percent_workable = (
			(case when((t4.icnt1_em + t4.icnt2_em) != 0) then(t4.icnt2_em / ((t4.icnt1_em + t4.icnt2_em) * 100)) else 0 end) +
			(case when((t2.icnt1_spl + t2.icnt2_spl) != 0) then(t2.icnt2_spl / ((t2.icnt1_spl + t2.icnt2_spl) * 100)) else 0 end) +
			(case when((t3.icnt1_ps + t3.icnt2_ps) != 0) then(t3.icnt2_ps / ((t3.icnt1_ps + t3.icnt2_ps) * 100)) else 0 end)
		) / 3
		from piping.dbo.iso t
		inner join #ttCountSpl t2
		on t.plant_no = t2.plant_no and
		   t.area_no = t2.area_no and
		   t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no
		inner join #ttCountPS t3
		on t.plant_no = t3.plant_no and
		   t.area_no = t3.area_no and
		   t.drawing_no = t3.drawing_no and
		   t.sheet_no = t3.sheet_no
		inner join #ttCountEM t4
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no and
		   t3.spool_no = t4.spool_no
		inner join piping.dbo.mat_takeoff_perspool t5
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no and
		   t3.spool_no = t4.spool_no
		where (t2.icnt1_spl + icnt2_spl) != 0 and
		      (t3.icnt1_ps + t3.icnt2_ps) != 0 and
		      lower(t5.spool_no) = ''em'';
		      
	update top (1) t
		set percent_workable = (
			(case when((t4.icnt1_em + t4.icnt2_em) != 0) then(t4.icnt2_em / ((t4.icnt1_em + t4.icnt2_em) * 100)) else 0 end) +
			(case when((t2.icnt1_spl + t2.icnt2_spl) != 0) then(t2.icnt2_spl / ((t2.icnt1_spl + t2.icnt2_spl) * 100)) else 0 end)
		) / 2
		from piping.dbo.iso t
		inner join #ttCountSpl t2
		on t.plant_no = t2.plant_no and
		   t.area_no = t2.area_no and
		   t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no
		inner join #ttCountPS t3
		on t2.plant_no = t3.plant_no and
		   t2.area_no = t3.area_no and
		   t2.drawing_no = t3.drawing_no and
		   t2.sheet_no = t3.sheet_no and
		   t2.spool_no = t3.spool_no
		inner join #ttCountEM t4
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no and
		   t3.spool_no = t4.spool_no
		inner join piping.dbo.mat_takeoff_perspool t5
		on t4.plant_no = t5.plant_no and
		   t4.area_no = t5.area_no and
		   t4.drawing_no = t5.drawing_no and
		   t4.sheet_no = t5.sheet_no and
		   t4.spool_no = t5.spool_no
		where (t2.icnt1_spl + icnt2_spl) != 0 and
		      (t3.icnt1_ps + t3.icnt2_ps) = 0 and
		      lower(t5.spool_no) = ''em'';
		      
	update top (1) t
		set percent_workable = (case when((t4.icnt1_em + t4.icnt2_em) != 0) then(t4.icnt2_em / ((t4.icnt1_em + t4.icnt2_em) * 100)) else 0 end)
		from piping.dbo.iso t
		inner join #ttCountSpl t2
		on t.plant_no = t2.plant_no and
		   t.area_no = t2.area_no and
		   t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no
		inner join #ttCountPS t3
		on t2.plant_no = t3.plant_no and
		   t2.area_no = t3.area_no and
		   t2.drawing_no = t3.drawing_no and
		   t2.sheet_no = t3.sheet_no and
		   t2.spool_no = t3.spool_no
		inner join #ttCountEM t4
		on t3.plant_no = t4.plant_no and
		   t3.area_no = t4.area_no and
		   t3.drawing_no = t4.drawing_no and
		   t3.sheet_no = t4.sheet_no and
		   t3.spool_no = t4.spool_no
		inner join piping.dbo.mat_takeoff_perspool t5
		on t4.plant_no = t5.plant_no and
		   t4.area_no = t5.area_no and
		   t4.drawing_no = t5.drawing_no and
		   t4.sheet_no = t5.sheet_no and
		   t4.spool_no = t5.spool_no
		where (t2.icnt1_spl + icnt2_spl) = 0 and
		      (t3.icnt1_ps + t3.icnt2_ps) = 0 and
		      lower(t5.spool_no) = ''em'';

	delete from tempdb_sql.dbo.ttMTO where loguser = @ip_loguser;
	delete from tempdb_sql.dbo.ttMTO1 where loguser = @ip_loguser;

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
/****** Object:  StoredProcedure [dbo].[proc_compute_jwrr]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[proc_compute_jwrr]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[proc_compute_jwrr]
	@ip_disc_code as varchar(max),
	@ip_PROGRESS_RECID as int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	begin transaction;
	declare @drawing_no varchar(max)
	declare @sheet_no varchar(max)
	declare @item_code varchar(max)
	declare @dlmr_jwrr tinyint	
	declare @direct_with tinyint	
	declare @old_dw tinyint	
	declare @old_dj tinyint	
	declare @iss_qty decimal
	declare @issue_date date
	
	declare @ireq as int
	
	select @drawing_no = drawing_no, @sheet_no = sheet_no, @item_code = item_code,
		   @dlmr_jwrr = dlmr_jwrr, @direct_with = direct_with, @old_dw = old_dw,
		   @iss_qty = iss_qty, @issue_date = issue_date
		from dbo.ttemp_conf where PROGRESS_RECID = @ip_PROGRESS_RECID
	
	if @ip_disc_code = ''STRL''
	begin
		set @ireq = 1;
		WHILE (@ireq <= @iss_qty)
		BEGIN
			if (@direct_with = 1 OR @dlmr_jwrr = 1)
			begin
				update t set t.mrr_qty = 1, t.received_dt = @issue_date, t.workable_pct = 100
					from piping.dbo.piece_struc t
					where t.piece_no = @item_code and
						  t.drawing_no = @drawing_no and
						  t.sheet_no = @sheet_no and
						  t.qty = 1 and
						  t.mrr_qty = 0
			end
			if (@old_dw = 1 and @direct_with = 0) or (@old_dj = 1 and @dlmr_jwrr = 0)			
			begin
				update t set t.mrr_qty = 0, t.received_dt = NULL, t.workable_pct = 0
					from piping.dbo.piece_struc t
					where t.piece_no = @item_code and
						  t.drawing_no = @drawing_no and
						  t.sheet_no = @sheet_no and
						  t.qty = 1 and
						  t.mrr_qty = 1
			end
			SET @ireq = @ireq + 1
		END		
		
		update t set t.workable_pct = t2.dcWork/t2.ipieceperiso
			from piping.dbo.iso_struc t
			inner join (
				select @drawing_no as drawing_no, @sheet_no as sheet_no, COUNT(drawing_no) as iPieceperiso, SUM(workable_pct) as dcWork
					from piping.dbo.piece_struc
					where drawing_no = @drawing_no and
						  sheet_no = @sheet_no
			) t2
			on t.drawing_no = t2.drawing_no and
			   t.sheet_no = t2.sheet_no
	end

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
/****** Object:  StoredProcedure [dbo].[issconf_ps_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[issconf_ps_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[issconf_ps_sp]
	-- Add the parameters for the stored procedure here
	@ip_jmif_no as varchar(max),
	@disc_code as varchar(max),
	@nsuserid as varchar(max),
	@ip_issue_date as date,
	@ip_issued_by as varchar(max),
	@ip_recvd_by as varchar(max),
	@ip_supp_code as varchar(max),
	@ip_pr_po_no as varchar(max),
	@ip_pl_dn_inv as varchar(max),
	@warning as varchar(max) output
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	declare @dcUpdQty decimal
	declare @cDLMRNo varchar(max)
	declare @cJWRRNo varchar(max)
	declare @op_riRepo decimal
	declare @op_riUpdate decimal
	declare @op_iRs int
		
	declare @drawing_no varchar(max)
	declare @plant_no varchar(max)
	declare @sheet_no varchar(max)
	declare @spool_no varchar(max)
	declare @stock_no varchar(max)
	declare @size varchar(max)
	declare @jmif_no varchar(max)	
	declare @req_qty decimal	
	declare @iss_qty decimal
	declare @direct_with tinyint	
	declare @old_ex tinyint	
	declare @old_iss decimal
	declare @old_dw tinyint	
	declare @dlmr_jwrr tinyint	
	declare @old_dj tinyint
	declare @supp_code varchar(max)
	declare @pl_dn_inv varchar(max)
	declare @pr_po_no varchar(max)
	declare @item_code varchar(max)
	declare @commodity_code varchar(max)
	declare @uom varchar(max)
	declare @spl_type varchar(max)
	declare @mat_desc varchar(max)
	declare @area_no varchar(max)
	declare @rev_no varchar(max)
	declare @issue_date date
	declare @PROGRESS_RECID as integer
	declare @ireq as integer
	declare @jmif_date as date
	declare @date_reqd as date
	declare @sub_date_fog as date
	declare @sub_date_client as date
	declare @mat_type as varchar(max)
	
	begin transaction;
    -- Insert statements for procedure here	
	update t
		set t.req_qty = t2.req_qty, t.iss_qty = t2.iss_qty,
			t.dlmr_jwrr = t2.dlmr_jwrr, t.drawing_no = t2.drawing_no,
			t.direct_with = t2.direct_with,
			t.mat_status = (case when t.req_qty <= t.iss_qty then ''CLOSED'' when t.iss_qty > 0 then ''PARTIAL'' else ''OPEN'' end),
			t.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP)),
			t.issue_date = (case when t2.liss = 1 then @ip_issue_date else t2.issue_date end),
			t.issued_by = (case when t2.liss = 1 then @ip_issued_by else t2.issued_by end),
			t.recvd_by = (case when t2.liss = 1 then @ip_recvd_by else t2.recvd_by end),
			t.supp_code = (case when t2.liss = 1 then @ip_supp_code else t.supp_code end),
			t.pr_po_no = (case when t2.liss = 1 then @ip_pr_po_no else t.pr_po_no end),
			t.pl_dn_inv = (case when t2.liss = 1 then @ip_pl_dn_inv else t.pl_dn_inv end)
		from piping.dbo.treqiss_dtl t
		inner join dbo.ttemp_conf t2
		on t.jmif_no = t2.jmif_no and
		   t.stock_no = t2.stock_no and
		   t.item_code = t2.item_code and
		   t.commodity_code = t2.commodity_code and
		   t.size = t2.size and		   
		   t.spl_type = t2.spl_type and		   
		   t.drawing_no = t2.drawing_no and
		   t.spool_no = t2.spool_no and
		   t.disc_code = t2.disc_code and
		   isnull(t.isc_no,'''') = isnull(t2.isc_no,'''')
	
	declare crs cursor read_only
		for select drawing_no, plant_no, sheet_no, spool_no, stock_no, size, jmif_no, req_qty, iss_qty, direct_with, old_ex, old_iss, old_dw, dlmr_jwrr, old_dj,
				   supp_code, pl_dn_inv, pr_po_no, item_code, commodity_code, uom, spl_type, mat_desc, area_no, rev_no, issue_date, spl_type, @PROGRESS_RECID from dbo.ttemp_conf

    -- Insert statements for procedure here			
	open crs
	fetch next from crs into @drawing_no, @plant_no, @sheet_no, @spool_no, @stock_no, @size, @jmif_no, @req_qty, @iss_qty, @direct_with, @old_ex, @old_iss, @old_dw, @dlmr_jwrr, @old_dj,
		@supp_code, @pl_dn_inv, @pr_po_no, @item_code, @commodity_code, @uom, @spl_type, @mat_desc, @area_no, @rev_no, @issue_date, @mat_type, @PROGRESS_RECID
	while @@FETCH_STATUS = 0
	begin		
	
		if not exists(select top (1) * from piping.dbo.material_file where isnull(stock_no,'''') = isnull(@stock_no,'''') and commodity_code = @commodity_code and size = @size and isnull(mat_type,'''') = isnull(@mat_type,''''))
		begin
			select @warning = ''Material File with Stock No. '' + @stock_no + '' Item Code: '' + @item_code + '' Commodity Code: '' + @commodity_code + '' Size: '' + @size + '' Matl Type: '' + @mat_type + '' does not exist!'';
			goto _ERROR
		end
	
		update top (1) t
			set t.qty_issued = t.qty_issued + (case when (@direct_with = 0) then (case when (@old_ex = 1) then @iss_qty else (@iss_qty - @old_iss) end) else @iss_qty end),
				t.qty_onhand = t.qty_onhand - (case when (@direct_with = 0) then (case when (@old_ex = 1) then @iss_qty else (@iss_qty - @old_iss) end) else @iss_qty end)
			from piping.dbo.material_file t
			where t.stock_no = @stock_no and
				  t.item_code = @item_code and
				  t.commodity_code = @commodity_code and
				  t.size = @size and
				  t.mat_type = @mat_type
				  
		set @dcUpdQty = (case when (@direct_with = 1 and @old_dw = 1) OR (@dlmr_jwrr = 1 and @old_dj = 1) then (@iss_qty - @old_iss) else @iss_qty end)
		if (@direct_with = 1 and @dlmr_jwrr = 1)
		begin
			if exists(select top (1) * from piping.dbo.tdlmr_hdr where jmif_no = @jmif_no and dlmr_no != @jmif_no)
				select @cDLMRNo = dlmr_no from piping.dbo.tdlmr_hdr where jmif_no = @jmif_no and dlmr_no != @jmif_no
			else
			begin
				set @cDLMRNo = ''DLMR-'' + @jmif_no
				
				if not exists(select top (1) * from piping.dbo.rcontrol where trancode = ''DLMR'')
				begin
					select @warning = ''DLMR does not exists in control no. reference.'';
					goto _ERROR
				end
			end						
											
			merge piping.dbo.tdlmr_hdr as target
			using (select @cDLMRNo, @supp_code, @pl_dn_inv, @pr_po_no, @jmif_no, @dlmr_jwrr,
					(select t.jmif_date from piping.dbo.treqiss_hdr t where t.jmif_no = @ip_jmif_no and t.disc_code = @disc_code) as jmif_date,
					(select isnull(t.supp_desc,'''') from piping.dbo.rsupplier t where t.supp_code = @supp_code) as supp_desc) as src
				  (dlmr_no, supp_code, pl_dn_inv, pr_po, jmif_no, dlmr_jwrr, jmif_date, supp_desc)
			on (target.dlmr_no = src.dlmr_no)
			when matched then
				update set target.supp_code = src.supp_code,
						   target.supp_desc = src.supp_desc,
						   target.pl_dn_inv = src.pl_dn_inv,
						   target.po_no = src.pr_po,
						   target.remarks = (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end)
			when not matched then
				insert (dlmr_no, dlmr_date, supp_code, supp_desc, pl_dn_inv, po_no, deliv_by, finalized, jmif_no, remarks, log_user, log_date, log_time)
				values (src.dlmr_no, src.jmif_date, src.supp_code, src.supp_desc, src.pl_dn_inv, src.pr_po, ''FOG - ARCC'', 1, src.jmif_no, (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end), @nsuserid, {fn NOW()}, convert(time,CURRENT_TIMESTAMP));
							
			merge piping.dbo.tdlmr_dtl as target
			using (select @cDLMRNo, @stock_no, @item_code, @commodity_code, @uom, @spl_type, @size, @jmif_no,
				  (select top (1) t.description from piping.dbo.material_file t where t.stock_no = @stock_no and t.item_code = @item_code and t.commodity_code = @commodity_code and t.size = @size) as description) as src
				  (dlmr_no, stock_no, item_code, commodity_code, uom, spl_type, size, jmif_no, description)
			on (target.dlmr_no = src.dlmr_no and
				target.stock_no = src.stock_no and
				target.item_code = src.item_code and
				target.commodity_code = src.commodity_code and
				target.size = src.size)
			when matched and target.dlmr_qty = 0 then delete
			when matched then
				update set target.dlmr_qty = target.dlmr_qty + @dcUpdQty,
						   target.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))
			when not matched then
				insert (dlmr_no, stock_no, stock_desc, item_code, commodity_code, uom, spl_type, size, jmif_no, log_user, log_date)
				values (src.dlmr_no, src.stock_no, src.description, src.item_code, src.commodity_code, src.uom, src.spl_type, src.size, src.jmif_no, @nsuserid, {fn NOW()});
				
			if exists(select top (1) * from piping.dbo.tjwrr_hdr where jmif_no = @jmif_no and jwrr_no != @jmif_no)
				select @cJWRRNo = jwrr_no from piping.dbo.tjwrr_hdr where jmif_no = @jmif_no and jwrr_no != @jmif_no
			else
			begin
				set @cJWRRNo = ''JWRR-'' + @jmif_no
				
				if not exists(select top (1) * from piping.dbo.rcontrol where trancode = ''JWRR'')
				begin
					select @warning = ''JWRR does not exists in control no. reference.'';
					goto _ERROR
				end
			end				
											
			merge piping.dbo.tjwrr_hdr as target
			using (select @cJWRRNo, @supp_code, @pl_dn_inv, @pr_po_no, @jmif_no, @disc_code, @dlmr_jwrr,
					(select t.jmif_date from piping.dbo.treqiss_hdr t where t.jmif_no = @ip_jmif_no and t.disc_code = @disc_code) as jmif_date,
					(select isnull(t.supp_desc,'''') from piping.dbo.rsupplier t where t.supp_code = @supp_code) as supp_desc) as src
				  (jwrr_no, supp_code, pl_dn_inv, pr_po, jmif_no, disc_code, dlmr_jwrr, jmif_date, supp_desc)
			on (target.jwrr_no = src.jwrr_no)
			when matched then
				update set target.disc_code = src.disc_code,
						   target.supp_code = src.supp_code,
						   target.supp_desc = src.supp_desc,
						   target.pl_dn_inv = src.pl_dn_inv,
						   target.pr_po_no = src.pr_po,
						   target.remarks = (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end)
			when not matched then
				insert (jwrr_no, jwrr_date, disc_code, supp_code, supp_desc, pl_dn_inv, pr_po_no, discount, jmif_no, finalized, remarks, log_user, log_date, log_time, log_update)
				values (src.jwrr_no, src.jmif_date, src.disc_code, src.supp_code, src.supp_desc, src.pl_dn_inv, src.pr_po, 0, src.jmif_no, 1, (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end), @nsuserid, {fn NOW()}, convert(time,CURRENT_TIMESTAMP), UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP)));
							
			merge piping.dbo.tjwrr_dtl as target
			using (select @cJWRRNo, @stock_no, @mat_desc, @item_code, @commodity_code, @uom, @size, @area_no, @drawing_no, @sheet_no, @rev_no, @spool_no, @spl_type, @jmif_no, @disc_code, @issue_date) as src
				  (jwrr_no, stock_no, mat_desc, item_code, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, spool_no, spl_type, jmif_no, disc_code, issue_date)
			on (target.jwrr_no = src.jwrr_no and
				target.stock_no = src.stock_no and
				target.item_code = src.item_code and
				target.commodity_code = src.commodity_code and
				target.size = src.size)
			when matched and target.jwrr_qty = 0 then delete
			when matched then
				update set target.disc_code = src.disc_code,
						   target.rcvd_date = src.issue_date,
						   target.jwrr_qty = target.jwrr_qty + @dcUpdQty,
						   target.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))
			when not matched then
				insert (jwrr_no, stock_no, stock_desc, item_code, commodity_code, uom, size, unit_cost, total_amt, area_no, drawing_no, sheet_no, rev_no, spl_type, jmif_no, disc_code, rcvd_date, log_user, log_date)
				values (src.jwrr_no, src.stock_no, src.mat_desc, src.item_code, src.commodity_code, src.uom, src.size, 0, 0, src.area_no, src.drawing_no, src.sheet_no, src.rev_no, src.spl_type, src.jmif_no, src.disc_code, src.issue_date, @nsuserid, {fn NOW()});				
				
			update top (1) t
			set t.qty_po = t.qty_po + @dcUpdQty,
				t.qty_mrr = t.qty_mrr + @dcUpdQty,
				t.qty_onhand = t.qty_onhand + @dcUpdQty
			from piping.dbo.material_file t
			where t.stock_no = @stock_no and
				  t.item_code = @item_code and
				  t.commodity_code = @commodity_code
		end		
		
		if (@old_dw = 1 and @direct_with = 0) or (@old_dj = 1 and @dlmr_jwrr = 0)
		begin
			exec dbo.proc_compute_1_sp @disc_code = @disc_code;
			
			update top (1) t
			set t.qty_po = t.qty_po - @dcUpdQty,
				t.qty_mrr = t.qty_mrr - @dcUpdQty,
				t.qty_onhand = t.qty_onhand - @dcUpdQty
			from piping.dbo.material_file t
			where t.stock_no = @stock_no and
				  t.item_code = @item_code and
				  t.commodity_code = @commodity_code
		end
		exec dbo.proc_compute_jwrr @ip_disc_code = @disc_code, @ip_PROGRESS_RECID = @PROGRESS_RECID;
				  
	fetch next from crs into @drawing_no, @plant_no, @sheet_no, @spool_no, @stock_no, @size, @jmif_no, @req_qty, @iss_qty, @direct_with, @old_ex, @old_iss, @old_dw, @dlmr_jwrr, @old_dj,
		@supp_code, @pl_dn_inv, @pr_po_no, @item_code, @commodity_code, @uom, @spl_type, @mat_desc, @area_no, @rev_no, @issue_date, @mat_type, @PROGRESS_RECID
	end
	close crs
	deallocate crs
	
	update t
		set t.iss_by = @nsuserid,
			t.jmif_status = (case when (t2.icnt_req != 0) then (case when (t2.icnt_req = t2.icnt_iss) then ''CLOSED'' else (case when (icnt_iss != 0) then ''PARTIAL'' when (t2.icnt_iss = 0) then (case when (t2.deqty_iss != 0) then ''PARTIAL'' else ''OPEN'' end) end) end) else t.jmif_status end),
			@op_riRepo = t2.op_riRepo, @op_riUpdate = t.PROGRESS_RECID,
			@op_iRs = (case when (t2.icnt_req != 0) then (case when (t2.icnt_req = t2.icnt_iss) then 3 else 2 end) else 0 end)
		from piping.dbo.treqiss_hdr t
		inner join (
			select COUNT(jmif_no) as icnt_req, sum(req_qty) as deqty_req,
				   sum(case when (iss_qty != 0 and iss_qty = req_qty) then 1 else 0 end) as icnt_iss, SUM(isnull(iss_qty,0)) as deqty_iss,
				   max(PROGRESS_RECID) as op_riRepo, MAX(jmif_no) as jmif_no
				from piping.dbo.treqiss_dtl where jmif_no = @jmif_no
		) t2
		on t.jmif_no = t2.jmif_no
		where t.jmif_no = @ip_jmif_no and
			  t.disc_code = @disc_code
		   
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
/****** Object:  StoredProcedure [dbo].[issconf_cvl_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[issconf_cvl_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[issconf_cvl_sp] 
	-- Add the parameters for the stored procedure here
	@ip_jmif_no as varchar(max),
	@disc_code as varchar(max),
	@nsuserid as varchar(max),
	@ip_issue_date as date,
	@ip_issued_by as varchar(max),
	@ip_recvd_by as varchar(max),
	@ip_supp_code as varchar(max),
	@ip_pr_po_no as varchar(max),
	@ip_pl_dn_inv as varchar(max),
	@warning as varchar(max) output
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;
		
	-- proc_compute	
	declare @dcUpdQty decimal
	declare @cDLMRNo varchar(max)
	declare @cJWRRNo varchar(max)
	declare @op_riRepo decimal
	declare @op_riUpdate decimal
	declare @op_iRs int
		
	declare @drawing_no varchar(max)
	declare @plant_no varchar(max)
	declare @sheet_no varchar(max)
	declare @spool_no varchar(max)
	declare @stock_no varchar(max)
	declare @size varchar(max)
	declare @jmif_no varchar(max)	
	declare @req_qty decimal	
	declare @iss_qty decimal
	declare @direct_with tinyint	
	declare @old_ex tinyint	
	declare @old_iss decimal
	declare @old_dw tinyint	
	declare @dlmr_jwrr tinyint	
	declare @old_dj tinyint
	declare @supp_code varchar(max)
	declare @pl_dn_inv varchar(max)
	declare @pr_po_no varchar(max)
	declare @item_code varchar(max)
	declare @commodity_code varchar(max)
	declare @uom varchar(max)
	declare @spl_type varchar(max)
	declare @mat_desc varchar(max)
	declare @area_no varchar(max)
	declare @rev_no varchar(max)
	declare @issue_date date
	declare @PROGRESS_RECID as integer
	declare @ireq as integer
	declare @jmif_date as date
	declare @date_reqd as date
	declare @sub_date_fog as date
	declare @sub_date_client as date
	
	update t
		set t.req_qty = t2.req_qty, t.iss_qty = t2.iss_qty, t.issue_date = (case when t2.liss = 1 then @ip_issue_date else t2.issue_date end),
			t.issued_by = (case when t2.liss = 1 then @ip_issued_by else t2.issued_by end), t.recvd_by = (case when t2.liss = 1 then @ip_recvd_by else t2.recvd_by end), t.drawing_no = t2.drawing_no,
			t.dlmr_jwrr = t2.dlmr_jwrr, t.direct_with = t2.direct_with, t.mat_status = (case when (t.req_qty <= t.iss_qty) then ''CLOSED'' else (case when (t.iss_qty > 0) then ''PARTIAL'' else ''OPEN'' end) end),
			t.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP)),
			t.supp_code = (case when (t2.liss = 1) then @ip_supp_code else t.supp_code end), t.pr_po_no = (case when (t2.liss = 1) then @ip_pr_po_no else t.pr_po_no end), t.pl_dn_inv = (case when (t2.liss = 1) then @ip_pl_dn_inv else t.pl_dn_inv end)
		from piping.dbo.treqiss_dtl t
		inner join dbo.ttemp_conf t2
		on t.jmif_no = t2.jmif_no
	
	declare crs cursor read_only
		for select drawing_no, plant_no, sheet_no, spool_no, stock_no, size, jmif_no, req_qty, iss_qty, direct_with, old_ex, old_iss, old_dw, dlmr_jwrr, old_dj,
				   supp_code, pl_dn_inv, pr_po_no, item_code, commodity_code, uom, spl_type, mat_desc, area_no, rev_no, issue_date, @PROGRESS_RECID from dbo.ttemp_conf

    -- Insert statements for procedure here			
	open crs
	fetch next from crs into @drawing_no, @plant_no, @sheet_no, @spool_no, @stock_no, @size, @jmif_no, @req_qty, @iss_qty, @direct_with, @old_ex, @old_iss, @old_dw, @dlmr_jwrr, @old_dj,
		@supp_code, @pl_dn_inv, @pr_po_no, @item_code, @commodity_code, @uom, @spl_type, @mat_desc, @area_no, @rev_no, @issue_date, @PROGRESS_RECID
	while @@FETCH_STATUS = 0
	begin		
	
		if not exists(select top (1) * from piping.dbo.material_file where stock_no = @stock_no and commodity_code = @commodity_code)
		begin
			select @warning = ''Material File with Stock No. '' + @stock_no + '' Piece Mark: '' + @commodity_code + '' does not exist!'';
			goto _ERROR;
		end
	
		update top (1) t
			set t.qty_issued = t.qty_issued + (case when (@direct_with = 0) then (case when (@old_ex = 1) then @iss_qty else (@iss_qty - @old_iss) end) else @iss_qty end),
				t.qty_onhand = t.qty_onhand - (case when (@direct_with = 0) then (case when (@old_ex = 1) then @iss_qty else (@iss_qty - @old_iss) end) else @iss_qty end)
			from piping.dbo.material_file t
			where t.stock_no = @stock_no and
				  t.item_code = @item_code and
				  t.commodity_code = @commodity_code
				  
		set @dcUpdQty = (case when (@direct_with = 1 and @old_dw = 1) OR (@dlmr_jwrr = 1 and @old_dj = 1) then (@iss_qty - @old_iss) else @iss_qty end)
		if (@direct_with = 1 and @dlmr_jwrr = 1)
		begin
			if exists(select top (1) * from piping.dbo.tdlmr_hdr where jmif_no = @jmif_no and dlmr_no != @jmif_no)
				select @cDLMRNo = dlmr_no from piping.dbo.tdlmr_hdr where jmif_no = @jmif_no and dlmr_no != @jmif_no
			else
			begin
				set @cDLMRNo = ''DLMR-'' + @jmif_no
				
				if not exists(select top (1) * from piping.dbo.rcontrol where trancode = ''DLMR'')
				begin
					select @warning = ''DLMR does not exists in control no. reference.'';
					goto _ERROR;
				end
			end						
											
			merge piping.dbo.tdlmr_hdr as target
			using (select @cDLMRNo, @supp_code, @pl_dn_inv, @pr_po_no, @jmif_no, @dlmr_jwrr,
					(select t.jmif_date from piping.dbo.treqiss_hdr t where t.jmif_no = @ip_jmif_no and t.disc_code = @disc_code) as jmif_date,
					(select isnull(t.supp_desc,'''') from piping.dbo.rsupplier t where t.supp_code = @supp_code) as supp_desc) as src
				  (dlmr_no, supp_code, pl_dn_inv, pr_po, jmif_no, dlmr_jwrr, jmif_date, supp_desc)
			on (target.dlmr_no = src.dlmr_no)
			when matched then
				update set target.supp_code = src.supp_code,
						   target.supp_desc = src.supp_desc,
						   target.pl_dn_inv = src.pl_dn_inv,
						   target.po_no = src.pr_po,
						   target.remarks = (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end)
			when not matched then
				insert (dlmr_no, dlmr_date, supp_code, supp_desc, pl_dn_inv, po_no, deliv_by, finalized, jmif_no, remarks, log_user, log_date, log_time)
				values (src.dlmr_no, src.jmif_date, src.supp_code, src.supp_desc, src.pl_dn_inv, src.pr_po, ''FOG - ARCC'', 1, src.jmif_no, (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end), @nsuserid, {fn NOW()}, convert(time,CURRENT_TIMESTAMP));
							
			merge piping.dbo.tdlmr_dtl as target
			using (select @cDLMRNo, @stock_no, @item_code, @commodity_code, @uom, @spl_type, @size, @jmif_no,
				  (select top (1) t.description from piping.dbo.material_file t where t.stock_no = @stock_no and t.item_code = @item_code and t.commodity_code = @commodity_code and t.size = @size) as description) as src
				  (dlmr_no, stock_no, item_code, commodity_code, uom, spl_type, size, jmif_no, description)
			on (target.dlmr_no = src.dlmr_no and
				target.stock_no = src.stock_no and
				target.item_code = src.item_code and
				target.commodity_code = src.commodity_code and
				target.size = src.size)
			when matched and target.dlmr_qty = 0 then delete
			when matched then
				update set target.dlmr_qty = target.dlmr_qty + @dcUpdQty,
						   target.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))
			when not matched then
				insert (dlmr_no, stock_no, stock_desc, item_code, commodity_code, uom, spl_type, size, jmif_no, log_user, log_date)
				values (src.dlmr_no, src.stock_no, src.description, src.item_code, src.commodity_code, src.uom, src.spl_type, src.size, src.jmif_no, @nsuserid, {fn NOW()});
				
			if exists(select top (1) * from piping.dbo.tjwrr_hdr where jmif_no = @jmif_no and jwrr_no != @jmif_no)
				select @cJWRRNo = jwrr_no from piping.dbo.tjwrr_hdr where jmif_no = @jmif_no and jwrr_no != @jmif_no
			else
			begin
				set @cJWRRNo = ''JWRR-'' + @jmif_no
				
				if not exists(select top (1) * from piping.dbo.rcontrol where trancode = ''JWRR'')
				begin
					select @warning = ''JWRR does not exists in control no. reference.'';
					goto _ERROR;
				end
			end				
											
			merge piping.dbo.tjwrr_hdr as target
			using (select @cJWRRNo, @supp_code, @pl_dn_inv, @pr_po_no, @jmif_no, @disc_code, @dlmr_jwrr,
					(select t.jmif_date from piping.dbo.treqiss_hdr t where t.jmif_no = @ip_jmif_no and t.disc_code = @disc_code) as jmif_date,
					(select isnull(t.supp_desc,'''') from piping.dbo.rsupplier t where t.supp_code = @supp_code) as supp_desc) as src
				  (jwrr_no, supp_code, pl_dn_inv, pr_po, jmif_no, disc_code, dlmr_jwrr, jmif_date, supp_desc)
			on (target.jwrr_no = src.jwrr_no)
			when matched then
				update set target.disc_code = src.disc_code,
						   target.supp_code = src.supp_code,
						   target.supp_desc = src.supp_desc,
						   target.pl_dn_inv = src.pl_dn_inv,
						   target.pr_po_no = src.pr_po,
						   target.remarks = (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end)
			when not matched then
				insert (jwrr_no, jwrr_date, disc_code, supp_code, supp_desc, pl_dn_inv, pr_po_no, discount, jmif_no, finalized, remarks, log_user, log_date, log_time, log_update)
				values (src.jwrr_no, src.jmif_date, src.disc_code, src.supp_code, src.supp_desc, src.pl_dn_inv, src.pr_po, 0, src.jmif_no, 1, (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end), @nsuserid, {fn NOW()}, convert(time,CURRENT_TIMESTAMP), UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP)));
							
			merge piping.dbo.tjwrr_dtl as target
			using (select @cJWRRNo, @stock_no, @mat_desc, @item_code, @commodity_code, @uom, @size, @area_no, @drawing_no, @sheet_no, @rev_no, @spool_no, @spl_type, @jmif_no, @disc_code, @issue_date) as src
				  (jwrr_no, stock_no, mat_desc, item_code, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, spool_no, spl_type, jmif_no, disc_code, issue_date)
			on (target.jwrr_no = src.jwrr_no and
				target.stock_no = src.stock_no and
				target.item_code = src.item_code and
				target.commodity_code = src.commodity_code and
				target.size = src.size)
			when matched and target.jwrr_qty = 0 then delete
			when matched then
				update set target.disc_code = src.disc_code,
						   target.rcvd_date = src.issue_date,
						   target.jwrr_qty = target.jwrr_qty + @dcUpdQty,
						   target.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))
			when not matched then
				insert (jwrr_no, stock_no, stock_desc, item_code, commodity_code, uom, size, unit_cost, total_amt, area_no, drawing_no, sheet_no, rev_no, spl_type, jmif_no, disc_code, rcvd_date, log_user, log_date)
				values (src.jwrr_no, src.stock_no, src.mat_desc, src.item_code, src.commodity_code, src.uom, src.size, 0, 0, src.area_no, src.drawing_no, src.sheet_no, src.rev_no, src.spl_type, src.jmif_no, src.disc_code, src.issue_date, @nsuserid, {fn NOW()});				
				
			update top (1) t
			set t.qty_po = t.qty_po + @dcUpdQty,
				t.qty_mrr = t.qty_mrr + @dcUpdQty,
				t.qty_onhand = t.qty_onhand + @dcUpdQty
			from piping.dbo.material_file t
			where t.stock_no = @stock_no and
				  t.item_code = @item_code and
				  t.commodity_code = @commodity_code
		end		
		
		if (@old_dw = 1 and @direct_with = 0) or (@old_dj = 1 and @dlmr_jwrr = 0)
		begin
			exec dbo.proc_compute_1_sp @disc_code = @disc_code;
			
			update top (1) t
			set t.qty_po = t.qty_po - @dcUpdQty,
				t.qty_mrr = t.qty_mrr - @dcUpdQty,
				t.qty_onhand = t.qty_onhand - @dcUpdQty
			from piping.dbo.material_file t
			where t.stock_no = @stock_no and
				  t.item_code = @item_code and
				  t.commodity_code = @commodity_code
		end
		exec dbo.proc_compute_jwrr @ip_disc_code = @disc_code, @ip_PROGRESS_RECID = @PROGRESS_RECID;
				  
	fetch next from crs into @drawing_no, @plant_no, @sheet_no, @spool_no, @stock_no, @size, @jmif_no, @req_qty, @iss_qty, @direct_with, @old_ex, @old_iss, @old_dw, @dlmr_jwrr, @old_dj,
		@supp_code, @pl_dn_inv, @pr_po_no, @item_code, @commodity_code, @uom, @spl_type, @mat_desc, @area_no, @rev_no, @issue_date, @PROGRESS_RECID
	end
	close crs
	deallocate crs	
	
	update t
		set t.iss_by = @nsuserid,
			t.jmif_status = (case when (t2.icnt_req != 0) then (case when (t2.icnt_req = t2.icnt_iss) then ''CLOSED'' else (case when (icnt_iss != 0) then ''PARTIAL'' when (t2.icnt_iss = 0) then (case when (t2.deqty_iss != 0) then ''PARTIAL'' else ''OPEN'' end) end) end) else t.jmif_status end),
			@op_riRepo = t2.op_riRepo, @op_riUpdate = t.PROGRESS_RECID,
			@op_iRs = (case when (t2.icnt_req != 0) then (case when (t2.icnt_req = t2.icnt_iss) then 3 else 2 end) else 0 end)
		from piping.dbo.treqiss_hdr t
		inner join (
			select COUNT(jmif_no) as icnt_req, sum(req_qty) as deqty_req,
				   sum(case when (iss_qty != 0 and iss_qty = req_qty) then 1 else 0 end) as icnt_iss, SUM(iss_qty) as deqty_iss,
				   max(PROGRESS_RECID) as op_riRepo, MAX(jmif_no) as jmif_no
				from piping.dbo.treqiss_dtl where jmif_no = @jmif_no
		) t2
		on t.jmif_no = t2.jmif_no
		where t.jmif_no = @ip_jmif_no and
			  t.disc_code = @disc_code
			  
	if @disc_code = ''strl''
	begin	
		declare crs2 cursor read_only
			for select drawing_no, sheet_no, item_code, req_qty from piping.dbo.treqiss_dtl where jmif_no = @ip_jmif_no and disc_code = @disc_code

		-- Insert statements for procedure here			
		open crs2
		fetch next from crs2 into @drawing_no, @sheet_no, @item_code, @req_qty
		while @@FETCH_STATUS = 0
		begin			  
			if exists(select top (1) * from piping.dbo.treqiss_hdr where disc_code = @disc_code and jmif_no = @ip_jmif_no)
			begin
				-- set @ireq = 1;				
				select @ireq = 1, @jmif_date = jmif_date, @date_reqd = date_reqd,
					@sub_date_fog = sub_date_fog, @sub_date_client = sub_date_client
					from piping.dbo.treqiss_hdr 
					where disc_code = @disc_code and @jmif_no = @ip_jmif_no
					
				WHILE (@ireq <= @req_qty)
				BEGIN				
					update t set t.issued_dt = @jmif_date, t.reqd_dt = @date_reqd,
								 t.fog_submitted_dt = @sub_date_fog, t.client_submitted_dt = @sub_date_client
						from piping.dbo.piece_struc t
						where t.piece_no = @item_code and
							  t.drawing_no = @drawing_no and
							  t.sheet_no = @sheet_no and
							  t.qty = 1 and
							  t.mrr_qty = 1 and
							  t.issueddt is null;
					set @ireq = @ireq + 1;
				end
			end
		fetch next from crs2 into @drawing_no, @sheet_no, @item_code, @req_qty
		end
		close crs2
		deallocate crs2	
	end

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
/****** Object:  StoredProcedure [dbo].[proc_compute_conf_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[proc_compute_conf_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[proc_compute_conf_sp]
	-- Add the parameters for the stored procedure here
	@ip_jmif_no varchar(max),
	@ip_disc_code varchar(max),
	@nsuserid varchar(max),
	@ip_issueddate date,
	@warning varchar(max) output
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	begin transaction;		
	
	declare @dcUpdQty decimal
	declare @cDLMRNo varchar(max)
	declare @cJWRRNo varchar(max)
	declare @op_riRepo decimal
	declare @op_riUpdate decimal
	declare @op_iRs int
		
	declare @drawing_no varchar(max)
	declare @plant_no varchar(max)
	declare @sheet_no varchar(max)
	declare @spool_no varchar(max)
	declare @stock_no varchar(max)
	declare @size varchar(max)
	declare @jmif_no varchar(max)	
	declare @req_qty decimal	
	declare @iss_qty decimal
	declare @direct_with tinyint	
	declare @old_ex tinyint	
	declare @old_iss decimal
	declare @old_dw tinyint	
	declare @dlmr_jwrr tinyint	
	declare @old_dj tinyint
	declare @supp_code varchar(max)
	declare @pl_dn_inv varchar(max)
	declare @pr_po_no varchar(max)
	declare @item_code varchar(max)
	declare @commodity_code varchar(max)
	declare @uom varchar(max)
	declare @spl_type varchar(max)
	declare @mat_desc varchar(max)
	declare @area_no varchar(max)
	declare @rev_no varchar(max)
	declare @issue_date date
	
	exec piping.dbo.proc_date_sp @ip_jmifno = @ip_jmif_no, @ip_disc_code = @ip_disc_code, @ip_issueddate = @ip_issueddate
	
	declare crs cursor read_only
		for select drawing_no, plant_no, sheet_no, spool_no, stock_no, size, jmif_no, req_qty, iss_qty, direct_with, old_ex, old_iss, old_dw, dlmr_jwrr, old_dj,
				   supp_code, pl_dn_inv, pr_po_no, item_code, commodity_code, uom, spl_type, mat_desc, area_no, rev_no, issue_date from dbo.ttemp_conf

    -- Insert statements for procedure here			
	open crs
	fetch next from crs into @drawing_no, @plant_no, @sheet_no, @spool_no, @stock_no, @size, @jmif_no, @req_qty, @iss_qty, @direct_with, @old_ex, @old_iss, @old_dw, @dlmr_jwrr, @old_dj,
		@supp_code, @pl_dn_inv, @pr_po_no, @item_code, @commodity_code, @uom, @spl_type, @mat_desc, @area_no, @rev_no, @issue_date
	while @@FETCH_STATUS = 0
	begin	
		if exists(select top (1) * from piping.dbo.recv_alloc
				where drawing_no = @drawing_no and
					  plant_no = @plant_no and
					  sheet_no = @sheet_no and
					  spool_no = @spool_no and
					  stock_no = @stock_no and
					  size = @size and
					  jmif_no = @jmif_no and
					  req_qty = @req_qty)
		begin
			update top (1) t
				set t.qty_allocated  = (case when t.qty_allocated != 0 then t.qty_allocated - @iss_qty else t.qty_allocated end),
					t.qty_onhand = t.qty_onhand - (case when (@direct_with = 1) then (case when (@old_ex = 1) then @iss_qty else (@iss_qty - @old_iss) end) else @iss_qty end),
					t.qty_issued = t.qty_issued + (case when (@direct_with = 1) then (case when (@old_ex = 1) then @iss_qty else (@iss_qty - @old_iss) end) else @iss_qty end)
				from piping.dbo.material_file t
				inner join (
					select top (1) t2.stock_no, t2.item_code, t2.commodity_code, t2.size
						from piping.dbo.recv_alloc t2
						where t2.drawing_no = @drawing_no and
							  t2.plant_no = @plant_no and
							  t2.sheet_no = @sheet_no and
							  t2.spool_no = @spool_no and
							  t2.stock_no = @stock_no and
							  t2.size = @size and
							  t2.jmif_no = @jmif_no and
							  t2.req_qty = @req_qty
				) t2
				on t.stock_no = t2.stock_no and
				   t.item_code = t2.item_code and
				   t.commodity_code = t2.commodity_code and
				   t.size = t2.size
		end		
		set @dcUpdQty = (case when (@direct_with = 1 and @old_dw = 1) OR (@dlmr_jwrr = 1 and @old_dj = 1) then (@iss_qty - @old_iss) else @iss_qty end)
		if (@direct_with = 1 and @dlmr_jwrr = 1)
		begin
			if exists(select top (1) * from piping.dbo.tdlmr_hdr where jmif_no = @jmif_no and dlmr_no != @jmif_no)
				select @cDLMRNo = dlmr_no from piping.dbo.tdlmr_hdr where jmif_no = @jmif_no and dlmr_no != @jmif_no
			else
			begin
				set @cDLMRNo = ''DLMR-'' + @jmif_no
				
				if not exists(select top (1) * from piping.dbo.rcontrol where trancode = ''DLMR'')
				begin
					select @warning = ''DLMR does not exists in control no. reference.'';
					goto _ERROR
				end
			end			
											
			merge piping.dbo.tdlmr_hdr as target
			using (select @cDLMRNo, @supp_code, @pl_dn_inv, @pr_po_no, @jmif_no, @dlmr_jwrr,
					(select t.jmif_date from piping.dbo.treqiss_hdr t where t.jmif_no = @ip_jmif_no and t.disc_code = @ip_disc_code) as jmif_date,
					(select isnull(t.supp_desc,'''') from piping.dbo.rsupplier t where t.supp_code = @supp_code) as supp_desc) as src
				  (dlmr_no, supp_code, pl_dn_inv, pr_po, jmif_no, dlmr_jwrr, jmif_date, supp_desc)
			on (target.dlmr_no = src.dlmr_no)
			when matched then
				update set target.supp_code = src.supp_code,
						   target.supp_desc = src.supp_desc,
						   target.pl_dn_inv = src.pl_dn_inv,
						   target.po_no = src.pr_po,
						   target.remarks = (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end)
			when not matched then
				insert (dlmr_no, dlmr_date, supp_code, supp_desc, pl_dn_inv, po_no, deliv_by, finalized, jmif_no, remarks, log_user, log_date, log_time)
				values (src.dlmr_no, src.jmif_date, src.supp_code, src.supp_desc, src.pl_dn_inv, src.pr_po, ''FOG - ARCC'', 1, src.jmif_no, (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end), @nsuserid, {fn NOW()}, convert(time,CURRENT_TIMESTAMP));
							
			merge piping.dbo.tdlmr_dtl as target
			using (select @cDLMRNo, @stock_no, @item_code, @commodity_code, @uom, @spl_type, @size, @jmif_no,
				  (select top (1) t.description from piping.dbo.material_file t where t.stock_no = @stock_no and t.item_code = @item_code and t.commodity_code = @commodity_code and t.size = @size) as description) as src
				  (dlmr_no, stock_no, item_code, commodity_code, uom, spl_type, size, jmif_no, description)
			on (target.dlmr_no = src.dlmr_no and
				target.stock_no = src.stock_no and
				target.item_code = src.item_code and
				target.commodity_code = src.commodity_code and
				target.size = src.size)
			when matched and target.dlmr_qty = 0 then delete
			when matched then
				update set target.dlmr_qty = target.dlmr_qty + @dcUpdQty,
						   target.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))
			when not matched then
				insert (dlmr_no, stock_no, stock_desc, item_code, commodity_code, uom, spl_type, size, jmif_no, log_user, log_date)
				values (src.dlmr_no, src.stock_no, src.description, src.item_code, src.commodity_code, src.uom, src.spl_type, src.size, src.jmif_no, @nsuserid, {fn NOW()});
				
			if exists(select top (1) * from piping.dbo.tjwrr_hdr where jmif_no = @jmif_no and jwrr_no != @jmif_no)
				select @cJWRRNo = jwrr_no from piping.dbo.tjwrr_hdr where jmif_no = @jmif_no and jwrr_no != @jmif_no
			else
			begin
				set @cJWRRNo = ''JWRR-'' + @jmif_no
				
				if not exists(select top (1) * from piping.dbo.rcontrol where trancode = ''JWRR'')
				begin
					select @warning = ''JWRR does not exists in control no. reference.'';
					goto _ERROR
				end
			end				
											
			merge piping.dbo.tjwrr_hdr as target
			using (select @cJWRRNo, @supp_code, @pl_dn_inv, @pr_po_no, @jmif_no, @ip_disc_code, @dlmr_jwrr,
					(select t.jmif_date from piping.dbo.treqiss_hdr t where t.jmif_no = @ip_jmif_no and t.disc_code = @ip_disc_code) as jmif_date,
					(select isnull(t.supp_desc,'''') from piping.dbo.rsupplier t where t.supp_code = @supp_code) as supp_desc) as src
				  (jwrr_no, supp_code, pl_dn_inv, pr_po, jmif_no, disc_code, dlmr_jwrr, jmif_date, supp_desc)
			on (target.jwrr_no = src.jwrr_no)
			when matched then
				update set target.disc_code = src.disc_code,
						   target.supp_code = src.supp_code,
						   target.supp_desc = src.supp_desc,
						   target.pl_dn_inv = src.pl_dn_inv,
						   target.pr_po_no = src.pr_po,
						   target.remarks = (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end)
			when not matched then
				insert (jwrr_no, jwrr_date, supp_code, supp_desc, pl_dn_inv, pr_po_no, discount, jmif_no, disc_code, finalized, remarks, log_user, log_date, log_time, log_update)
				values (src.jwrr_no, src.jmif_date, src.supp_code, src.supp_desc, src.pl_dn_inv, src.pr_po, 0, src.jmif_no, src.disc_code, 1, (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end), @nsuserid, {fn NOW()}, convert(time,CURRENT_TIMESTAMP), UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP)));
							
			merge piping.dbo.tjwrr_dtl as target
			using (select @cJWRRNo, @stock_no, @mat_desc, @item_code, @commodity_code, @uom, @size, @area_no, @drawing_no, @sheet_no, @rev_no, @spool_no, @spl_type, @jmif_no, @ip_disc_code, @issue_date) as src
				  (jwrr_no, stock_no, mat_desc, item_code, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, spool_no, spl_type, jmif_no, disc_code, issue_date)
			on (target.jwrr_no = src.jwrr_no and
				target.stock_no = src.stock_no and
				target.item_code = src.item_code and
				target.commodity_code = src.commodity_code and
				target.size = src.size)
			when matched and target.jwrr_qty = 0 then delete
			when matched then
				update set target.disc_code = src.disc_code,
						   target.rcvd_date = src.issue_date,
						   target.jwrr_qty = target.jwrr_qty + @dcUpdQty,
						   target.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))
			when not matched then
				insert (jwrr_no, stock_no, stock_desc, item_code, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, spool_no, spl_type, jmif_no, disc_code, issue_date, log_user, log_date)
				values (src.jwrr_no, src.stock_no, src.mat_desc, src.item_code, src.commodity_code, src.uom, src.size, src.area_no, src.drawing_no, src.sheet_no, src.rev_no, src.spool_no, src.spl_type, src.jmif_no, src.disc_code, src.issue_date, @nsuserid, {fn NOW()});
				
			update top (1) t
				set t.jwrr_no = @cJWRRNo
				from piping.dbo.treqiss_dtl t
				inner join (
					select top (1) @plant_no as plant_no, @area_no as area_no, @drawing_no as drawing_no, @sheet_no as sheet_no,
						@rev_no as rev_no, @spool_no as spool_no, @commodity_code as commodity_code, @size as size, @jmif_no as jmif_no
						from piping.dbo.tjwrr_dtl t3
						where  t3.jwrr_no = @cJWRRNo and
							   t3.stock_no = @stock_no and
						       t3.item_code = @item_code and
						       t3.commodity_code = @commodity_code and
						       t3.size = @size
				) t2
				on t.plant_no = t2.plant_no and
				   t.area_no = t2.area_no and
				   t.drawing_no = t2.drawing_no and
				   t.sheet_no = t2.sheet_no and
				   t.rev_no = t2.rev_no and
				   t.spool_no = t2.spool_no and
				   t.commodity_code = t2.commodity_code and
				   t.size = t2.size and
				   t.jmif_no = t2.jmif_no
				   
			update top (1) t
				set t.qty_po = t.qty_po + @dcUpdQty,
					t.qty_mrr = t.qty_mrr + @dcUpdQty,
					t.qty_onhand = t.qty_onhand + @dcUpdQty
				from piping.dbo.material_file t
				where t.stock_no = @stock_no and
					  t.item_code = @item_code and
					  t.commodity_code = @commodity_code and
					  t.size = @size
					  
			exec piping.dbo.proc_compute_jwrr_sp @ip_jmif_no = @ip_jmif_no, @ip_disc_code = @ip_disc_code, @nsuserid = @nsuserid;
			
			update t
				set t.rcvd_by = t3.rcvd_by, t.rcvd_date = t3.rcvd_date,
					t.client_refno = t3.pr_po_no, t.client_refdate = t3.jwrr_date,
					t.rfi_no = t3.rfi_no, t.rfi_date = t3.rfi_date,
					t.qcmrir_no = t3.qcmrir_no, t.qcmrir_date = t3.qcmrir_date
				from piping.dbo.twhse_pip_mat t
				inner join piping.dbo.tjwrr_dtl t2
				on t.item_code = t2.item_code and
				   t.size = t2.size
				inner join piping.dbo.tjwrr_hdr t3
				on t2.jwrr_no = t3.jwrr_no
				where t.jmif_no = @jmif_no and
					  t3.disc_code = @ip_disc_code and
					  t3.jwrr_no = @cJWRRNo
		end
		
		if (@old_dw = 1 and @direct_with = 0) or (@old_dj = 1 and @dlmr_jwrr = 0)
		begin
			exec dbo.proc_compute_1_sp @disc_code = @ip_disc_code;
				   
			update top (1) t
				set t.qty_po = t.qty_po + @old_iss,
					t.qty_mrr = t.qty_mrr + @old_iss,
					t.qty_onhand = t.qty_onhand + @old_iss
				from piping.dbo.material_file t
				where t.stock_no = @stock_no and
					  t.item_code = @item_code and
					  t.commodity_code = @commodity_code and
					  t.size = @size			
		end
		
	fetch next from crs into @drawing_no, @plant_no, @sheet_no, @spool_no, @stock_no, @size, @jmif_no, @req_qty, @iss_qty, @direct_with, @old_ex, @old_iss, @old_dw, @dlmr_jwrr, @old_dj,
		@supp_code, @pl_dn_inv, @pr_po_no, @item_code, @commodity_code, @uom, @spl_type, @mat_desc, @area_no, @rev_no, @issue_date
	end
	close crs
	deallocate crs	
	
	update t
		set t.iss_by = @nsuserid,
			t.jmif_status = (case when (t2.icnt_req != 0) then (case when (t2.icnt_req = t2.icnt_iss) then ''CLOSED'' else (case when (icnt_iss != 0) then ''PARTIAL'' when (t2.icnt_iss = 0) then (case when (t2.deqty_iss != 0) then ''PARTIAL'' else ''OPEN'' end) end) end) else t.jmif_status end),
			@op_riRepo = t2.op_riRepo, @op_riUpdate = t.PROGRESS_RECID,
			@op_iRs = (case when (t2.icnt_req != 0) then (case when (t2.icnt_req = t2.icnt_iss) then 3 else 2 end) else 0 end)
		from piping.dbo.treqiss_hdr t
		inner join (
			select COUNT(jmif_no) as icnt_req, sum(req_qty) as deqty_req,
				   sum(case when (iss_qty != 0 and iss_qty = req_qty) then 1 else 0 end) as icnt_iss, SUM(iss_qty) as deqty_iss,
				   max(PROGRESS_RECID) as op_riRepo, MAX(jmif_no) as jmif_no
				from piping.dbo.treqiss_dtl where jmif_no = @jmif_no
		) t2
		on t.jmif_no = t2.jmif_no
		where t.jmif_no = @ip_jmif_no and
			  t.disc_code = @ip_disc_code
	    
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
/****** Object:  StoredProcedure [dbo].[issconf_spl_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[issconf_spl_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[issconf_spl_sp]
	-- Add the parameters for the stored procedure here
	@ip_jmif_no as varchar(max),
	@disc_code as varchar(max),
	@nsuserid as varchar(max),
	@ip_issue_date as date,
	@ip_issued_by as varchar(max),
	@ip_recvd_by as varchar(max),
	@ip_supp_code as varchar(max),
	@ip_pr_po_no as varchar(max),
	@ip_pl_dn_inv as varchar(max),
	@warning as varchar(max) output
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;
		
	-- proc_compute	
	declare @dcUpdQty decimal
	declare @cDLMRNo varchar(max)
	declare @cJWRRNo varchar(max)
	declare @op_riRepo decimal
	declare @op_riUpdate decimal
	declare @op_iRs int
		
	declare @drawing_no varchar(max)
	declare @plant_no varchar(max)
	declare @sheet_no varchar(max)
	declare @spool_no varchar(max)
	declare @stock_no varchar(max)
	declare @size varchar(max)
	declare @jmif_no varchar(max)	
	declare @req_qty decimal	
	declare @iss_qty decimal
	declare @direct_with tinyint	
	declare @old_ex tinyint	
	declare @old_iss decimal
	declare @old_dw tinyint	
	declare @dlmr_jwrr tinyint	
	declare @old_dj tinyint
	declare @supp_code varchar(max)
	declare @pl_dn_inv varchar(max)
	declare @pr_po_no varchar(max)
	declare @item_code varchar(max)
	declare @commodity_code varchar(max)
	declare @uom varchar(max)
	declare @spl_type varchar(max)
	declare @mat_desc varchar(max)
	declare @area_no varchar(max)
	declare @rev_no varchar(max)
	declare @issue_date date
	declare @PROGRESS_RECID as integer
	declare @ireq as integer
	declare @jmif_date as date
	declare @date_reqd as date
	declare @sub_date_fog as date
	declare @sub_date_client as date
	
	update t
		set t.req_qty = t2.req_qty, t.iss_qty = t2.iss_qty, t.issue_date = (case when t2.liss = 1 then @ip_issue_date else t2.issue_date end),
			t.issued_by = (case when t2.liss = 1 then @ip_issued_by else t2.issued_by end), t.recvd_by = (case when t2.liss = 1 then @ip_recvd_by else t2.recvd_by end), t.drawing_no = t2.drawing_no,
			t.dlmr_jwrr = t2.dlmr_jwrr, t.direct_with = t2.direct_with, t.mat_status = (case when (t.req_qty <= t.iss_qty) then ''CLOSED'' else (case when (t.iss_qty > 0) then ''PARTIAL'' else ''OPEN'' end) end),
			t.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP)),
			t.supp_code = (case when (t2.liss = 1) then @ip_supp_code else t.supp_code end), t.pr_po_no = (case when (t2.liss = 1) then @ip_pr_po_no else t.pr_po_no end), t.pl_dn_inv = (case when (t2.liss = 1) then @ip_pl_dn_inv else t.pl_dn_inv end)
		from piping.dbo.treqiss_dtl t
		inner join dbo.ttemp_conf t2
		on t.jmif_no = t2.jmif_no
	
	declare crs cursor read_only
		for select drawing_no, plant_no, sheet_no, spool_no, stock_no, size, jmif_no, req_qty, iss_qty, direct_with, old_ex, old_iss, old_dw, dlmr_jwrr, old_dj,
				   supp_code, pl_dn_inv, pr_po_no, item_code, commodity_code, uom, spl_type, mat_desc, area_no, rev_no, issue_date, @PROGRESS_RECID from dbo.ttemp_conf

    -- Insert statements for procedure here			
	open crs
	fetch next from crs into @drawing_no, @plant_no, @sheet_no, @spool_no, @stock_no, @size, @jmif_no, @req_qty, @iss_qty, @direct_with, @old_ex, @old_iss, @old_dw, @dlmr_jwrr, @old_dj,
		@supp_code, @pl_dn_inv, @pr_po_no, @item_code, @commodity_code, @uom, @spl_type, @mat_desc, @area_no, @rev_no, @issue_date, @PROGRESS_RECID
	while @@FETCH_STATUS = 0
	begin		
		if (@direct_with = 1 and @dlmr_jwrr = 1)
		begin
			if exists(select top (1) * from piping.dbo.tdlmr_hdr where jmif_no = @jmif_no and dlmr_no != @jmif_no)
				select @cDLMRNo = dlmr_no from piping.dbo.tdlmr_hdr where jmif_no = @jmif_no and dlmr_no != @jmif_no
			else
			begin
				set @cDLMRNo = ''DLMR-'' + @jmif_no
				
				if not exists(select top (1) * from piping.dbo.rcontrol where trancode = ''DLMR'')
				begin
					select @warning = ''DLMR does not exists in control no. reference.'';
					goto _ERROR;
				end
			end						
											
			merge piping.dbo.tdlmr_hdr as target
			using (select @cDLMRNo, @supp_code, @pl_dn_inv, @pr_po_no, @jmif_no, @dlmr_jwrr,
					(select t.jmif_date from piping.dbo.treqiss_hdr t where t.jmif_no = @ip_jmif_no and t.disc_code = @disc_code) as jmif_date,
					(select isnull(t.supp_desc,'''') from piping.dbo.rsupplier t where t.supp_code = @supp_code) as supp_desc) as src
				  (dlmr_no, supp_code, pl_dn_inv, pr_po, jmif_no, dlmr_jwrr, jmif_date, supp_desc)
			on (target.dlmr_no = src.dlmr_no)
			when matched then
				update set target.supp_code = src.supp_code,
						   target.supp_desc = src.supp_desc,
						   target.pl_dn_inv = src.pl_dn_inv,
						   target.po_no = src.pr_po,
						   target.remarks = (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end)
			when not matched then
				insert (dlmr_no, dlmr_date, supp_code, supp_desc, pl_dn_inv, po_no, deliv_by, finalized, jmif_no, remarks, log_user, log_date, log_time)
				values (src.dlmr_no, src.jmif_date, src.supp_code, src.supp_desc, src.pl_dn_inv, src.pr_po, ''FOG - ARCC'', 1, src.jmif_no, (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end), @nsuserid, {fn NOW()}, convert(time,CURRENT_TIMESTAMP));
							
			merge piping.dbo.tdlmr_dtl as target
			using (select @cDLMRNo, @stock_no, @item_code, @commodity_code, @uom, @spl_type, @size, @jmif_no,
				  (select top (1) t.description from piping.dbo.material_file t where t.stock_no = @stock_no and t.item_code = @item_code and t.commodity_code = @commodity_code and t.size = @size) as description) as src
				  (dlmr_no, stock_no, item_code, commodity_code, uom, spl_type, size, jmif_no, description)
			on (target.dlmr_no = src.dlmr_no and
				target.stock_no = src.stock_no and
				target.item_code = src.item_code and
				target.commodity_code = src.commodity_code and
				target.size = src.size)
			when matched and target.dlmr_qty = 0 then delete
			when matched then
				update set target.dlmr_qty = target.dlmr_qty + @dcUpdQty,
						   target.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))
			when not matched then
				insert (dlmr_no, stock_no, stock_desc, item_code, commodity_code, uom, spl_type, size, jmif_no, log_user, log_date)
				values (src.dlmr_no, src.stock_no, src.description, src.item_code, src.commodity_code, src.uom, src.spl_type, src.size, src.jmif_no, @nsuserid, {fn NOW()});
				
			if exists(select top (1) * from piping.dbo.tjwrr_hdr where jmif_no = @jmif_no and jwrr_no != @jmif_no)
				select @cJWRRNo = jwrr_no from piping.dbo.tjwrr_hdr where jmif_no = @jmif_no and jwrr_no != @jmif_no
			else
			begin
				set @cJWRRNo = ''JWRR-'' + @jmif_no
				
				if not exists(select top (1) * from piping.dbo.rcontrol where trancode = ''JWRR'')
				begin
					select @warning = ''JWRR does not exists in control no. reference.'';
					goto _ERROR;
				end
			end				
											
			merge piping.dbo.tjwrr_hdr as target
			using (select @cJWRRNo, @supp_code, @pl_dn_inv, @pr_po_no, @jmif_no, @disc_code, @dlmr_jwrr,
					(select t.jmif_date from piping.dbo.treqiss_hdr t where t.jmif_no = @ip_jmif_no and t.disc_code = @disc_code) as jmif_date,
					(select isnull(t.supp_desc,'''') from piping.dbo.rsupplier t where t.supp_code = @supp_code) as supp_desc) as src
				  (jwrr_no, supp_code, pl_dn_inv, pr_po, jmif_no, disc_code, dlmr_jwrr, jmif_date, supp_desc)
			on (target.jwrr_no = src.jwrr_no)
			when matched then
				update set target.disc_code = src.disc_code,
						   target.supp_code = src.supp_code,
						   target.supp_desc = src.supp_desc,
						   target.pl_dn_inv = src.pl_dn_inv,
						   target.pr_po_no = src.pr_po,
						   target.remarks = (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end)
			when not matched then
				insert (jwrr_no, jwrr_date, disc_code, supp_code, supp_desc, pl_dn_inv, pr_po_no, discount, jmif_no, finalized, remarks, log_user, log_date, log_time, log_update)
				values (src.jwrr_no, src.jmif_date, src.disc_code, src.supp_code, src.supp_desc, src.pl_dn_inv, src.pr_po, 0, src.jmif_no, 1, (case when (src.dlmr_jwrr = 1) then ''AUTO JWRR'' else ''Direct Withdraw'' end), @nsuserid, {fn NOW()}, convert(time,CURRENT_TIMESTAMP), UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP)));
							
			merge piping.dbo.tjwrr_dtl as target
			using (select @cJWRRNo, @stock_no, @mat_desc, @item_code, @commodity_code, @uom, @size, @area_no, @drawing_no, @sheet_no, @rev_no, @spool_no, @spl_type, @jmif_no, @disc_code, @issue_date) as src
				  (jwrr_no, stock_no, mat_desc, item_code, commodity_code, uom, size, area_no, drawing_no, sheet_no, rev_no, spool_no, spl_type, jmif_no, disc_code, issue_date)
			on (target.jwrr_no = src.jwrr_no and
				target.stock_no = src.stock_no and
				target.item_code = src.item_code and
				target.commodity_code = src.commodity_code and
				target.size = src.size)
			when matched and target.jwrr_qty = 0 then delete
			when matched then
				update set target.disc_code = src.disc_code,
						   target.rcvd_date = src.issue_date,
						   target.jwrr_qty = target.jwrr_qty + @dcUpdQty,
						   target.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP))
			when not matched then
				insert (jwrr_no, stock_no, stock_desc, item_code, commodity_code, uom, size, unit_cost, total_amt, area_no, drawing_no, sheet_no, rev_no, spl_type, jmif_no, disc_code, rcvd_date, log_user, log_date)
				values (src.jwrr_no, src.stock_no, src.mat_desc, src.item_code, src.commodity_code, src.uom, src.size, 0, 0, src.area_no, src.drawing_no, src.sheet_no, src.rev_no, src.spl_type, src.jmif_no, src.disc_code, src.issue_date, @nsuserid, {fn NOW()});
		end		
		
		if (@old_dw = 1 and @direct_with = 0) or (@old_dj = 1 and @dlmr_jwrr = 0)
		begin
			exec dbo.proc_compute_1_sp @disc_code = @disc_code;
		end
		
		update top (1) t set t.issued_date = @issue_date,
					 t.received_date = (case when (@direct_with = 1 OR @dlmr_jwrr = 1) then (case when (t.received_date is null) then @issue_date else t.received_date end) else t.received_date end),
					 t.erect_workable_pct = (case when (t.issued_date is null) then 0 else 100 end),
					 t.workable_pct = (case when (t.received_date is null) then 0 else 100 end)
			from piping.dbo.spool t
			where t.plant_no = @plant_no and
				  t.area_no = @area_no and
				  t.drawing_no = @drawing_no and
				  t.sheet_no = @sheet_no and
				  t.rev_no = @rev_no and
				  t.spool_no = @spool_no
			
		update t2 set t2.iso_workable_pct = (t3.dcspl100 / t3.ictr) * 100,
					  t2.iso_erect = (t3.dcerect100 / t3.ictr) * 100
			from piping.dbo.spool t2
			inner join (
				select COUNT(1) as ictr, COUNT(case when (t.workable_pct = 100) then 1 else 0 end) as dcspl100,
					COUNT(case when (t.erect_workable_pct = 100) then 1 else 0 end) as dcerect100, MAX(t.PROGRESS_RECID) as PROGRESS_RECID
					from piping.dbo.spool t
					where t.plant_no = @plant_no and
						  t.area_no = @area_no and
						  t.drawing_no = @drawing_no and
						  t.sheet_no = @sheet_no and
						  t.rev_no = @rev_no
					group by t.rev_no
			) t3
			on t2.PROGRESS_RECID = t3.PROGRESS_RECID
			
		update top (1) t2 set t2.workable_pct = (t3.dcspl100 / t3.ictr) * 100,
					   t2.erect_workable_pct = (t3.dcerect100 / t3.ictr) * 100
			from piping.dbo.iso t2
			inner join piping.dbo.spool t4
			on t2.plant_no = t4.plant_no and
			   t2.drawing_no = t4.drawing_no and
			   t2.sheet_no = t4.sheet_no and
			   t2.rev_no = t4.rev_no
			inner join (
				select COUNT(1) as ictr, COUNT(case when (t.workable_pct = 100) then 1 else 0 end) as dcspl100,
					COUNT(case when (t.erect_workable_pct = 100) then 1 else 0 end) as dcerect100, MAX(t.PROGRESS_RECID) as PROGRESS_RECID
					from piping.dbo.spool t
					where t.plant_no = @plant_no and
						  t.area_no = @area_no and
						  t.drawing_no = @drawing_no and
						  t.sheet_no = @sheet_no and
						  t.rev_no = @rev_no
					group by t.rev_no
			) t3
			on t4.PROGRESS_RECID = t3.PROGRESS_RECID
	
	fetch next from crs into @drawing_no, @plant_no, @sheet_no, @spool_no, @stock_no, @size, @jmif_no, @req_qty, @iss_qty, @direct_with, @old_ex, @old_iss, @old_dw, @dlmr_jwrr, @old_dj,
		@supp_code, @pl_dn_inv, @pr_po_no, @item_code, @commodity_code, @uom, @spl_type, @mat_desc, @area_no, @rev_no, @issue_date, @PROGRESS_RECID
	end
	close crs
	deallocate crs	
	
	update t
		set t.iss_by = @nsuserid,
			t.jmif_status = (case when (t2.icnt_req != 0) then (case when (t2.icnt_req = t2.icnt_iss) then ''CLOSED'' else (case when (icnt_iss != 0) then ''PARTIAL'' when (t2.icnt_iss = 0) then (case when (t2.deqty_iss != 0) then ''PARTIAL'' else ''OPEN'' end) end) end) else t.jmif_status end),
			@op_riRepo = t2.op_riRepo, @op_riUpdate = t.PROGRESS_RECID,
			@op_iRs = (case when (t2.icnt_req != 0) then (case when (t2.icnt_req = t2.icnt_iss) then 3 else 2 end) else 0 end)
		from piping.dbo.treqiss_hdr t
		inner join (
			select COUNT(jmif_no) as icnt_req, sum(req_qty) as deqty_req,
				   sum(case when (iss_qty != 0 and iss_qty = req_qty) then 1 else 0 end) as icnt_iss, SUM(iss_qty) as deqty_iss,
				   max(PROGRESS_RECID) as op_riRepo, MAX(jmif_no) as jmif_no
				from piping.dbo.treqiss_dtl where jmif_no = @jmif_no
		) t2
		on t.jmif_no = t2.jmif_no
		where t.jmif_no = @ip_jmif_no and
			  t.disc_code = @disc_code

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
/****** Object:  StoredProcedure [dbo].[issconf_sp]    Script Date: 03/18/2015 14:18:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[issconf_sp]') AND type in (N'P', N'PC'))
BEGIN
EXEC dbo.sp_executesql @statement = N'-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[issconf_sp]
	-- Add the parameters for the stored procedure here
	@ip_jmif_no as varchar(max),
	@disc_code as varchar(max),
	@nsuserid as varchar(max),
	@ip_issue_date as date,
	@ip_issued_by as varchar(max),
	@ip_recvd_by as varchar(max),
	@ip_supp_code as varchar(max),
	@ip_pr_po_no as varchar(max),
	@ip_pl_dn_inv as varchar(max),
	@warning as varchar(max) output
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;
	
	begin transaction;
		
	declare @stock_no varchar(max)
	declare @item_code varchar(max)
	declare @commodity_code varchar(max)
	declare @size varchar(max)
	declare @mat_desc varchar(max)
	declare @uom varchar(max)
	declare @direct_with tinyint	
	declare @old_dw tinyint	
	declare @dlmr_jwrr tinyint	
	declare @old_dj tinyint	
	declare @excess tinyint	
	declare @old_ex tinyint	
	declare @iss_qty decimal	
	declare @old_iss decimal	
	declare @req_qty decimal	
	declare @old_req decimal
	declare crs cursor read_only
		for select stock_no, item_code, commodity_code, size, mat_desc,
		uom, direct_with, old_dw, dlmr_jwrr, old_dj, excess, old_ex, iss_qty, old_iss,
		req_qty, old_req from dbo.ttemp_conf

    -- Insert statements for procedure here			
	open crs
	fetch next from crs into @stock_no, @item_code, @commodity_code, @size, @mat_desc,
		@uom, @direct_with, @old_dw, @dlmr_jwrr, @old_dj, @excess, @old_ex, @iss_qty, @old_iss,
		@req_qty, @old_req
	while @@FETCH_STATUS = 0
	begin		
		merge piping.dbo.material_file as target
		using (select @stock_no, @item_code, @commodity_code, @size, @mat_desc, @uom) as src
			  (stock_no, item_code, commodity_code, size, mat_desc, uom)
		on (target.stock_no = src.stock_no and
			target.item_code = src.item_code and
			target.commodity_code = src.commodity_code and
			target.size = src.size
		   )
		when not matched then
			insert (stock_no, item_code, commodity_code, size, uom, flg_status)
			values (src.stock_no, src.item_code, src.commodity_code, src.size, src.uom, 1);
			
		merge piping.dbo.material_file_dtl as target
		using (select @stock_no, @item_code, @commodity_code, @size) as src
			  (stock_no, item_code, commodity_code, size)
		on (target.stock_no = src.stock_no and
			target.item_code = src.item_code and
			target.commodity_code = src.commodity_code and
			target.disc_code = @disc_code
		   )
		when not matched then
			insert (stock_no, item_code, commodity_code, disc_code, flg_status, size)
			values (src.stock_no, src.item_code, src.commodity_code, @disc_code, 1, src.size);
			
		merge piping.dbo.mat_excess as target
		using (select @stock_no, @item_code, @commodity_code, @size) as src
			  (stock_no, item_code, commodity_code, size)
		on (target.commodity_code = src.commodity_code and
			target.size = @size
		   )
		when not matched then
			insert (stock_no, item_code, commodity_code, size, log_user, log_date, log_time)
			values (src.stock_no, src.item_code, src.commodity_code, src.size, @nsuserid, {fn NOW()}, convert(time,CURRENT_TIMESTAMP));
						
		fetch next from crs into @stock_no, @item_code, @commodity_code, @size, @mat_desc,
			@uom, @direct_with, @old_dw, @dlmr_jwrr, @old_dj, @excess, @old_ex, @iss_qty, @old_iss,
			@req_qty, @old_req
	end
	close crs
	deallocate crs
	
	declare @dcExcess as decimal
	declare @onhand_qty as decimal
	declare crs3 cursor read_only
		for select stock_no, item_code, commodity_code, size, mat_desc,
			uom, direct_with, old_dw, dlmr_jwrr, old_dj, excess, old_ex, iss_qty, old_iss,
			req_qty, old_req, t2.onhand_qty from dbo.ttemp_conf t 
			inner join (
				select top (1) MAX(t4.progress_recid) as progress_recid, max(t3.onhand_qty) as onhand_qty from piping.dbo.mat_excess t3
					inner join dbo.ttemp_conf t4
					on t3.commodity_code = t4.commodity_code and
					   t3.size = t4.size
			) t2
			on t.progress_recid = t2.progress_recid

	open crs3
	fetch next from crs3 into @stock_no, @item_code, @commodity_code, @size, @mat_desc,
		@uom, @direct_with, @old_dw, @dlmr_jwrr, @old_dj, @excess, @old_ex, @iss_qty, @old_iss,
		@req_qty, @old_req, @onhand_qty
	while @@FETCH_STATUS = 0
	begin
	
		if (@iss_qty > @req_qty)
		begin
			set @dcExcess = (case when @old_iss = 0 then (@iss_qty - @req_qty) else ((@iss_qty - @old_iss) - (@req_qty - @old_req)) end)
			
			if ((@onhand_qty + @dcExcess) < 0)
			begin
				select @warning = ''Insufficient Qty.<br />Kindly see your Excess Material Inventory.'';
				goto _ERROR
			end
		end
		
		if ((@iss_qty <= @req_qty) and (@old_iss > @old_req))
		begin
			set @dcExcess = (@old_iss - @old_req)
			
			if ((@onhand_qty - @dcExcess) < 0)
			begin
				select @warning = ''Insufficient Qty.<br />Kindly see your Excess Material Inventory.'';
				goto _ERROR				
			end
		end
		
		if ((@excess = 1) or (@old_ex = 1))
		begin
			set @dcExcess = (case when @excess = 1 and @old_ex = 1 then (@iss_qty - @old_iss) when @excess = 1 and @old_ex = 0 then @iss_qty when @excess = 0 and @old_ex = 0 then @old_iss else 0 end)
			
			if (((@onhand_qty - @dcExcess) < 0) and (@excess = 1))
			begin
				select @warning = ''Insufficient Excess Material.<br />Kindly check your Inventory.'';
				goto _ERROR
			end
		end
						
		fetch next from crs3 into @stock_no, @item_code, @commodity_code, @size, @mat_desc,
			@uom, @direct_with, @old_dw, @dlmr_jwrr, @old_dj, @excess, @old_ex, @iss_qty, @old_iss,
			@req_qty, @old_req, @onhand_qty
	end
	close crs3
	deallocate crs3
		
	declare @qty_onhand as decimal(22,4)
	declare @qty_po as decimal(17,4)
	declare @progress_recid as decimal
	declare crs2 cursor read_only
		for select stock_no, item_code, commodity_code, size, mat_desc,
			uom, direct_with, old_dw, dlmr_jwrr, old_dj, excess, old_ex, iss_qty, old_iss,
			req_qty, old_req, t.progress_recid, t2.qty_onhand, t2.qty_po
			from dbo.ttemp_conf t 
			inner join (
				select top (1) MAX(t4.progress_recid) as progress_recid, MAX(isnull(t3.qty_onhand, 0)) as qty_onhand, max(isnull(t3.qty_po,0)) as qty_po
					from piping.dbo.material_file t3
					inner join dbo.ttemp_conf t4
					on t3.commodity_code = t4.commodity_code and
					   t3.size = t4.size
					where t4.disc_code = @disc_code
			) t2
			on t.progress_recid = t2.progress_recid

	open crs2
	fetch next from crs2 into @stock_no, @item_code, @commodity_code, @size, @mat_desc,
		@uom, @direct_with, @old_dw, @dlmr_jwrr, @old_dj, @excess, @old_ex, @iss_qty, @old_iss,
		@req_qty, @old_req, @progress_recid, @qty_onhand, @qty_po
	while @@FETCH_STATUS = 0
	begin
		if (@direct_with = 0 and @old_dw = 0) and (@dlmr_jwrr = 0 and @old_dj = 0) and @excess = 0 and @iss_qty != 0 and ((@qty_onhand - (@iss_qty - @old_iss)) < 0)
		begin
			select @warning = ''Invalid Transaction<br />Not enough Material Qty. on-hand<br />Stock No.: '' + @stock_no + ''<br />Size: '' + @size;
			goto _ERROR
		end
	
		if (@direct_with = 0 and @old_dw = 1) and (@dlmr_jwrr = 0 and @old_dj = 0) and (((@qty_po - @old_iss) - (case when @excess = 1 then 0 else @iss_qty end)) < 0)
		begin
			select @warning = ''Invalid Transaction<br />Please check Issued Qty. inputs.'';
			goto _ERROR
		end
		
		if (@direct_with = 0 and @old_dw = 1) and (@dlmr_jwrr = 0 and @old_dj = 0) and ((@qty_onhand - (case when @excess = 1 then 0 else @iss_qty end)) > 0)
		begin
			select @warning = ''Invalid Transaction<br />Please check Issued Qty. inputs.'';
			goto _ERROR
		end
			
		if (@direct_with = 0 and @old_dw = 0) and (@dlmr_jwrr = 0 and @old_dj = 1) and (((@qty_po - @old_iss) - (case when @excess = 1 then 0 else @iss_qty end)) < 0)
		begin
			select @warning = ''Invalid Transaction<br />Please check Issued Qty. inputs.'';
			goto _ERROR
		end
		
		if (@direct_with = 0 and @old_dw = 0) and (@dlmr_jwrr = 0 and @old_dj = 1) and ((@qty_onhand - (case when @excess = 1 then 0 else @iss_qty end)) < 0)
		begin
			select @warning = ''Invalid Transaction<br />Please check Issued Qty. inputs.'';
			goto _ERROR
		end
				
		update t set valid = 1 from dbo.ttemp_conf t where PROGRESS_RECID = @progress_recid
		
		if (@excess = 0)
			update t set t.qty_onhand = t.qty_onhand - (case when @old_ex = 1 then @iss_qty else (@iss_qty - @old_iss) end),
						 t.qty_issued = t.qty_issued + (case when @old_ex = 1 then @iss_qty else (@iss_qty - @old_iss) end)
				from piping.dbo.material_file t
				where t.commodity_code = @commodity_code and
					  t.size = @size;
						
		fetch next from crs2 into @stock_no, @item_code, @commodity_code, @size, @mat_desc,
			@uom, @direct_with, @old_dw, @dlmr_jwrr, @old_dj, @excess, @old_ex, @iss_qty, @old_iss,
			@req_qty, @old_req, @progress_recid, @qty_onhand, @qty_po
	end
	close crs2
	deallocate crs2
	
	update t
		set t.req_qty = t2.req_qty, t.iss_qty = t2.iss_qty,
			t.dlmr_jwrr = t2.dlmr_jwrr,
			t.direct_with = t2.direct_with, t.excess = t2.excess,
			t.mat_status = (case when t.req_qty <= t.iss_qty then ''CLOSED'' when t.iss_qty > 0 then ''PARTIAL'' else ''OPEN'' end),
			t.log_update = UPPER(@nsuserid) + '' '' + CONVERT(varchar,{fn NOW()}) + '' '' + convert(varchar,convert(time,CURRENT_TIMESTAMP)),
			t.issue_date = (case when t2.liss = 1 then @ip_issue_date else t2.issue_date end),
			t.issued_by = (case when t2.liss = 1 then @ip_issued_by else t2.issued_by end),
			t.recvd_by = (case when t2.liss = 1 then @ip_recvd_by else t2.recvd_by end),
			t.supp_code = (case when t2.liss = 1 then @ip_supp_code else t.supp_code end),
			t.pr_po_no = (case when t2.liss = 1 then @ip_pr_po_no else t.pr_po_no end),
			t.pl_dn_inv = (case when t2.liss = 1 then @ip_pl_dn_inv else t.pl_dn_inv end)
		from piping.dbo.treqiss_dtl t
		inner join dbo.ttemp_conf t2
		on t.plant_no = t2.plant_no and
		   t.area_no = t2.area_no and
		   t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   t.rev_no = t2.rev_no and
		   t.spool_no = t2.spool_no and
		   t.commodity_code = t2.commodity_code and
		   t.size = t2.size and
		   t.jmif_no = t2.jmif_no and
		   t.isc_no = t2.isc_no
		   
	update t
		set t.iss_qty = t2.iss_qty
		from piping.dbo.recv_alloc t
		inner join dbo.ttemp_conf t2
		on t.plant_no = t2.plant_no and
		   t.area_no = t2.area_no and
		   t.drawing_no = t2.drawing_no and
		   t.sheet_no = t2.sheet_no and
		   t.rev_no = t2.rev_no and
		   t.spool_no = t2.spool_no and
		   t.commodity_code = t2.commodity_code and
		   t.size = t2.size and
		   t.jmif_no = t2.jmif_no
		   
	exec dbo.proc_excess_sp @nsuserid = @nsuserid;
	exec dbo.proc_ex_compute_sp;
	exec dbo.proc_compute_conf_sp @ip_jmif_no = @ip_jmif_no, @ip_disc_code = @disc_code, @nsuserid = @nsuserid, @ip_issueddate = @ip_issue_date, @warning = @warning output
    
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
END' 
END
GO
