//CONSULTA PARA TRAER LOS CURSOS DE ACUERDO AL USUARIO
SELECT 
	public.td_curso_usuario.curd_id,
	public.tm_curso.cur_id,
	public.tm_curso.cur_nombre,
	public.tm_curso.cur_descrip,
	public.tm_curso.cur_fechini,
	public.tm_curso.cur_fechfin,
	public.tm_usuario.usu_id,
	public.tm_usuario.usu_nom,
	public.tm_usuario.usu_apep,
	public.tm_usuario.usu_apem,
	public.tm_instructor.inst_nombre,
	public.tm_instructor.inst_apep,
	public.tm_instructor.inst_apem
FROM 
	public.td_curso_usuario 
INNER JOIN 
	public.tm_curso ON public.td_curso_usuario.cur_id = public.tm_curso.cur_id
INNER JOIN 
	public.tm_usuario ON public.td_curso_usuario.usu_id = public.tm_usuario.usu_id
INNER JOIN
	public.tm_instructor ON public.td_curso_usuario.inst_id = public.tm_instructor.inst_id
WHERE 
	public.tm_usuario.usu_id=1