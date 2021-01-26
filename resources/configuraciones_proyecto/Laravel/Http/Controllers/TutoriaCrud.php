<?php 

namespace Modules\Robotica\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Http\Requests;

use Modules\Robotica\Entities\Cliente_Resource;

use Illuminate\Http\Request;
use Modules\Robotica\Http\Requests\CreateAdministrativoRequest;

use App\Http\Controllers\Nova\NovaController;
use Carbon\Carbon;

class TutoriaCrud extends NovaController {
	
	function __construct()
	{
        parent::__construct();
	}

	/**
	* Function Controller:index
	* Description:  Display a listing of the resource.
	* Date created: 05-05-2016
	* Cretated by : andres Macancela J
	*               [amacancela][@][novatechnology.com.ec]
	* I/O Specifications:
	* @return Response
	*/
	public function index()
	{
		// Devolverá todos las Sucursal Factura.		
		$this->novaMessage->addInfoMessage('Show all','Mostrando todos los registros');
		$this->novaMessage->setData(['list'=>Tutoria::all()]);
		return $this->returnJSONMessage();
	}
	

	/**
	* Function Controller:store
	* Description: Show a form to Create a new register.
	* Date created: 09-05-2016
	* Cretated by : andres Macancela J
	*               [amacancela][@][novatechnology.com.ec]
	* I/O Specifications:
	* @return Response
	*/

	public function store(Request $request)
	{
		// Primero comprobaremos si estamos recibiendo todos los campos.
		//if($request->input('app_token')==1234567890)
		//{
	  	if (!$request->input('sucursaldocumentoelectronico_id') || !$request->input('persona_id')){
	    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
	    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.

			$this->novaMessage->addErrorMessage('Error','Faltan datos necesarios para el proceso de alta.');
			return $this->returnJSONMessage(422);
	  	}

		// Insertamos una fila en Empresa con create pasándole todos los datos recibidos.
		// En $request->all() tendremos todos los campos del formulario recibidos.


		$nuevoCliente=Tutoria::create($request->all());

		$cli_fechacreacion = Carbon::now();
		$nuevoCliente->cli_fechacreacion = $cli_fechacreacion;
		$nuevoCliente->save();

		// Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un POST que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.
		$this->novaMessage->addInfoMessage('Created','Se registro correctamente al Cliente.');			
		$this->novaMessage->setRoute('/public/administrativo/cliente/'.$nuevoCliente->id);
		return $this->returnJSONMessage(201);
	}


	/**
	* Function Controller:show
	* Description: Display the specified resource.
	* Date created: 09-05-2016
	* Cretated by : andres Macancela J
	*               [amacancela][@][novatechnology.com.ec]
	* I/O Specifications:
	* @param  int  $id
	* @return Response
	*/

	public function show($id,Request $request)
	{		
		// Buscamos un Cuenta por el id.
		// return "Se muestra Cuenta con id: $id";		
		$cliente_resource=Tutoria::find($id);
		if (!count($cliente_resource)) {
			$this->novaMessage->addSuccesMessage('Error','No existen Clientes registrados.');
			return $this->returnJSONMessage(404);
		}

		// Si no existe esa Cuenta devolvemos un error.
		if (!$cliente_resource)	{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
		  	// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
		  	$this->novaMessage->addErrorMessage('Error','No existe el Cliente.');
			return $this->returnJSONMessage(404);
		}

		if ($request->method() === 'GET')	{
			//Validacion para verificar que cada unos de los valores enviados no este vacio.			
			$this->novaMessage->addErrorMessage('Exist','Se obtuvo el Cliente consultada.');
			$this->novaMessage->setRoute('/public/administrativo/cliente/'.$cliente_resource->id);
			$this->novaMessage->setData(['list'=>$cliente_resource]);
			return $this->returnJSONMessage(302);
			
		}		
	}


	/**
	* Function Controller:update (PUT o PATCH)
	* Description: Update the specified resource in storage.
	* Date created: 13-05-2016
	* Cretated by : andres Macancela J
	*               [amacancela][@][novatechnology.com.ec]
	* I/O Specifications:
	* @param  int  $id
	* @return Response
	*/
	public function update($id,Request $request)
	{

		//// Comprobamos si la cuenta que nos están pasando no existe, devuelve un mensaje de error, y un codigo asocido.
		$cliente_resource = Tutoria::find($id);
		if (!$cliente_resource)	{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
		  	// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
		  	$this->novaMessage->addErrorMessage('Error','No existe el Cliente.');
			return $this->returnJSONMessage(404);
		}

		if ($request->input('id'))	{			
			$this->novaMessage->addErrorMessage('Error','No se permite actualizar al codigo ingresado.');
			return $this->returnJSONMessage(406);			
		}

		//Validacion para verificar por cada campo si fue mencionado en el request, para luego proceder con la actualizacion.
		if ($request->input('cli_fechacreacion'))	{				
			$cliente_resource->cli_fechacreacion = $request->input('cli_fechacreacion');
		}
		if ($request->input('persona_id'))	{				
			$cliente_resource->persona_id = $request->input('persona_id');
		}			
		if ($request->input('sucursalfactura_id'))	{				
			$cliente_resource->sucursalfactura_id = $request->input('sucursalfactura_id');
		}			
		if ($request->input('cli_estado'))	{
				$cliente_resource->cli_estado = $request->input('cli_estado'); 
		}


		if ($request->method() === 'PATCH'){	
			// Almacenamos en la base de datos el registro.			
			$cliente_resource->save();
			$this->novaMessage->addSuccesMessage('Updated','Se actualizo correctamente el Cliente.');
			$this->novaMessage->setRoute('/public/administrativo/cliente/'.$cliente_resource->id);
			return $this->returnJSONMessage(202);
		}
		else	{	//PUT

			// Si el método no es PATCH entonces es PUT y tendremos que actualizar todos los datos.
			if (!$request->input('cli_fechacreacion') || !$request->input('persona_id') || !$request->input('sucursalfactura_id'))	{
				// Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.

				$this->novaMessage->addSuccesMessage('Error','Faltan valores para completar la actualizacion.');				
				return $this->returnJSONMessage(422);

			}
			else	{
				$cliente_resource->cli_fechacreacion = $request->input('cli_fechacreacion'); 								
				$cliente_resource->persona_id = $request->input('persona_id');
				if ($request->input('cli_estado'))	{
					$cliente_resource->cli_estado = $request->input('cli_estado'); 
				}

				// Actualizamos en la base de datos el registro.
				$cliente_resource->save();
				$this->novaMessage->addSuccesMessage('Updated','Se actualizo correctamente el Cliente.');
				$this->novaMessage->setRoute('/public/administrativo/cliente/'.$cliente_resource->id);
				return $this->returnJSONMessage(202);
			}
		}
	}


	/**
	* Function Controller:destroy (DELETE)
	* Description: Remove the specified resource from storage.
	* Date created: 05-05-2016
	* Cretated by : andres Macancela J
	*               [amacancela][@][novatechnology.com.ec]
	* I/O Specifications:
	*
	* @param  int  $id
	* @return Response
	*/

	public function destroy($id,Request $request)
	{
		$cli_estado = 0;
		//Eliminacion logica del registro encontrado
		$cliente_resource = Tutoria::find($id);
		if (!$cliente_resource)	{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
		  	// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
		  	$this->novaMessage->addErrorMessage('Error','No existe el Cliente.');
			return $this->returnJSONMessage(404);

		}

		if ($request->method() === 'DELETE')	{
			//Validacion para verificar que no envie el id en el request.
			if (!$request->input('id'))	{
				$cliente_resource->$cli_estado; 
				$cliente_resource->cli_estado = $request->input('cli_estado'); 

				// Actualizamos en la base de datos el registro al estado Inactivo (0).			
				$cliente_resource->save();
				$this->novaMessage->addSuccesMessage('Deleted','Se elimino correctamente el Cliente.');			
				return $this->returnJSONMessage(202);
			}
			else{		
				$this->novaMessage->addSuccesMessage('Error','No se permite enviar datos en la baja solicitada.');				
				return $this->returnJSONMessage(422);	//Entidad no procesada.		
			}
	
		}
	}
	
}