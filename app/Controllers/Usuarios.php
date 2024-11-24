<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuario;
use App\Models\Gallery;

class Usuarios extends Controller{


    public function index(){
        $datos['cabecera']= view('template/cabecera');
        $datos['pie']= view('template/piepagina');

        return view('inicio', $datos);
    }

    public function listar(){

        $usuario= new Usuario();
        $datos['usuarios']= $usuario->orderBy('id','ASC')->FindAll();

        $datos['cabecera']= view('template/cabecera');
        $datos['pie']= view('template/piepagina');

        return view('usuarios/listar', $datos);
    }

    public function crear(){

        
    }

    public function guardar(){
        $usuario= new Usuario();

        //$nombre= $this->request->getVar('nombre');
        //$email= $this->request->getVar('email');
        //$password= $this->request->getVar('password');

        $datos=[
            'nombre'=> $this->request->getVar('nombre'),
            'email'=> $this->request->getVar('email'),
            'password'=> password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ];
        $usuario->insert($datos);

        
        return $this->response->redirect(site_url('/listar'));
    }

    public function borrar($id=null){
        $usuario= new Usuario();
        $datosUsuario=$usuario->where('id',$id)->first();

        $usuario->where('id',$id)->delete($id);

        return $this->response->redirect(site_url('/listar'));
    }

    public function editar($id=null){
        print_r($id);
        $usuario= new Usuario();

        $datos['usuario']=$usuario->where('id',$id)->first();

        $datos['cabecera']= view('template/cabecera');
        $datos['pie']= view('template/piepagina');
      
        return view('usuarios/editar', $datos);
    }

    public function actualizar(){
        $usuario= new Usuario();

        $datos=[
            'nombre'=> $this->request->getVar('nombre'),
            'email'=> $this->request->getVar('email'),
            'password'=> $this->request->getVar('password')
        ];
        $id= $this->request->getVar('id');

        $usuario->update($id,$datos);

        return $this->response->redirect(site_url('/listar'));
    }

    public function iniciosesion(){

        $datos['cabecera']= view('template/cabecera');
        $datos['pie']= view('template/piepagina');

        return view('usuarios/iniciosesion', $datos);
    }

   /* public function ingresar(){
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->where('email', $email)->first();

        if ($usuario){

            if (password_verify($password, $usuario['password'])){

                session()->set([
                    'usuario_id' => $usuario['id'],
                    'usuario_nombre' => $usuario['nombre'],
                    'usuario_email' => $usuario['email']
                ]);

                return redirect()->to('/perfil');
            } else {

                return redirect()->back()->with('error', 'Contraseña incorrecta');
            }
        } else {
            return redirect()->back()->with('error', 'El correo electrónico no está registrado');
        }
} */

    public function ingresar(){
        // Recuperar el correo electrónico y la contraseña del formulario
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        // Buscar el usuario en la base de datos por correo electrónico
        $usuario = new Usuario();
        $usuarioEncontrado = $usuario->where('email', $email)->first();
    
        // Verificar si se encontró un usuario con ese correo electrónico
        if ($usuarioEncontrado) {
            // Verificar si la contraseña coincide
            if (password_verify($password, $usuarioEncontrado['password'])) {
            // Iniciar sesión y redirigir al perfil del usuario
            session()->set([
                'id' => $usuarioEncontrado['id'],
                'nombre' => $usuarioEncontrado['nombre'],
                'email' => $usuarioEncontrado['email']
            ]);

            return redirect()->to('/perfil');


            } else {
                // Contraseña incorrecta, mostrar un mensaje de error
                return redirect()->back()->with('error', 'Contraseña incorrecta');
            }
        } else {
            // El usuario no existe, mostrar un mensaje de error
            return redirect()->back()->with('error', 'El correo electrónico no está registrado');
        }
    }

    public function perfil(){
        // Verificar si el usuario ha iniciado sesión
        if(!session()->get('email')){
            // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
            return redirect()->to(site_url('iniciosesion'))->with('error', 'Debes iniciar sesión para ver tu perfil');
        }
    
        // Mostrar galeria
        $gallery= new Gallery();
        $usuario_id = session()->get('id');
        $datos['galleries']= $gallery->where('usuario_id', $usuario_id)->orderBy('id','ASC')->FindAll();
        
        // Cargar la vista del perfil
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');
        return view('usuarios/perfil', $datos);
    }

    public function crearGaleria(){

        $datos['cabecera']= view('template/cabecera');
        $datos['pie']= view('template/piepagina');

        return view('usuarios/crearGaleria', $datos);
    }

    public function guardarGaleria(){
        $gallery= new Gallery();
        $usuario_id = session()->get('id');

        if($imagen= $this->request->getFile('imagen')){
            $nuevoNombre= $imagen->getRandomName();
            
            if($imagen->move('../public/uploads/',$nuevoNombre)){
                $datos=[
                    'imagen'=>$nuevoNombre,
                    'usuario_id'=> $usuario_id
                ];
            
                $gallery->insert($datos);
                return $this->response->redirect(site_url('/perfil'))       ; 

            }
            else{
                return $this->response->redirect(site_url('/crearGaleria'))->with('error', 'Error al subir la imagen');            
            } 
        } else{
            return $this->response->redirect(site_url('/crearGaleria'))->with('error', 'No se seleccionó ninguna imagen');
        }
    }

    public function borrarGaleria($id=null){
        $gallery= new Gallery();
        $usuario_id = session()->get('id');
        $datosGallery=$gallery->where(['id' => $id, 'usuario_id' => $usuario_id])->first();

        if ($datosGallery) {
            $ruta = ('../public/uploads/' . $datosGallery['imagen']);
            if (file_exists($ruta)) {
                unlink($ruta);
            }
            $gallery->where('id', $id)->delete($id);
            return $this->response->redirect(site_url('/perfil'));
        } else {
            return $this->response->redirect(site_url('/perfil'));
        } 
    }
   

}