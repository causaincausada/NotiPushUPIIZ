package com.example.notipushupiiz;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.messaging.FirebaseMessaging;
import com.google.gson.Gson;

import org.json.JSONObject;

import JSON_IN.Alumno_JSON;
import JSON_IN.Empleado_JSON;

public class MainActivity extends AppCompatActivity {

    private final String nombre_archivo = "credenciales";
    EditText et_Boleta;
    Spinner sp_Tipo;
    Button btn_ingresar;

    String token;
    String data_nombre;
    String data_programa;
    String data_boleta;
    String data_tipo;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        checkLogin();
        enlazarVistas();
        addListeners();
    }

    private void checkLogin() {
        SharedPreferences preferences = getSharedPreferences(nombre_archivo, Context.MODE_PRIVATE);//Nombre del archivo
        if (preferences.getBoolean("logeado", false)) {
            //startActivity(new Intent(getApplicationContext(), MenuApp.class));
        }
    }

    private void login() {
        //Obtenemos los valores de ususaio y contraseña
        String boleta = et_Boleta.getText().toString();
        String tipo = sp_Tipo.getSelectedItem().toString();

        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        String url = "";

        if (tipo.equals("Alumno")) {
            url = "http://10.0.2.2/NotiPushUPIIZ/API/alumno.php?boleta=" + boleta;
        } else if (tipo.equals("PAAE")) {
            url = "http://10.0.2.2/NotiPushUPIIZ/API/empleado.php?numempleado=" + boleta;
        }

        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Gson api_JSON = new Gson();

                        if (tipo.equals("Alumno")) {
                            Alumno_JSON respuesta_alumno = api_JSON.fromJson(response, Alumno_JSON.class);
                            if (respuesta_alumno.getError()) {
                                Toast.makeText(getApplicationContext(), respuesta_alumno.getError_Mensaje(), Toast.LENGTH_LONG).show();
                            } else {
                                if (respuesta_alumno.getEncontrado()) {
                                    data_nombre = respuesta_alumno.getData_alumno().get(0).getNombre();
                                    data_boleta = respuesta_alumno.getData_alumno().get(0).getBoleta();
                                    data_programa = respuesta_alumno.getData_alumno().get(0).getPrograma();
                                    data_tipo = sp_Tipo.getSelectedItem().toString();
                                    getToken();
                                    loginWeb();
                                } else {
                                    Toast.makeText(getApplicationContext(), "Alumno no encontrado, verifique su boleta.", Toast.LENGTH_LONG).show();
                                }
                            }
                        } else if (tipo.equals("PAAE")) {
                            Empleado_JSON respuesta_empleado = api_JSON.fromJson(response, Empleado_JSON.class);
                            if (respuesta_empleado.getError()) {
                                Toast.makeText(getApplicationContext(), respuesta_empleado.getError_Mensaje(), Toast.LENGTH_LONG).show();
                            } else {
                                if (respuesta_empleado.getEncontrado()) {
                                    data_nombre = respuesta_empleado.getData_empleado().get(0).getNombre();
                                    data_boleta = respuesta_empleado.getData_empleado().get(0).getNumempleado();
                                    data_programa = respuesta_empleado.getData_empleado().get(0).getPrograma();
                                    data_tipo = sp_Tipo.getSelectedItem().toString();
                                    getToken();
                                    loginWeb();
                                } else {
                                    Toast.makeText(getApplicationContext(), "Empleado no encontrado, verifique su número de trabajador.", Toast.LENGTH_LONG).show();
                                }
                            }
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Error al conectarse a los servidores.", Toast.LENGTH_LONG).show();
            }
        });

        queue.add(stringRequest);
    }

    private void loginWeb(){
        SharedPreferences preferences = getSharedPreferences(nombre_archivo, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();

        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        String url = "http://192.168.1.69/api/empleado.php";
        int metodo = 0;
        JSONObject parametros = new JSONObject();
        parametros.put("Nombre", nombre);
        parametros.put("Usuario", usuario);
        parametros.put("Contrasena", contrasena);
        if (opcion == MenuApp.ALTA) {
            metodo = Request.Method.POST;
            parametros.put("ID_Creador", "" + iD_Sesion);
        } else if (opcion == MenuApp.ACTUALIZAR) {
            metodo = Request.Method.PUT;
            url += "?ID=" + iD_Usuario;
        }

        JsonObjectRequest jsonobj = new JsonObjectRequest(metodo, url, parametros,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        Gson json_ExisteUsuario = new Gson();
                        Respuesta_Simple_JSON respuesta = json_ExisteUsuario.fromJson("" + response, Respuesta_Simple_JSON.class);
                        if (respuesta.getError()) {
                            Toast.makeText(getApplicationContext(), getString(R.string.error_API) + " " + respuesta.getError_Mensaje(), Toast.LENGTH_LONG).show();

                            String mensaje_error = "";
                            if (opcion == MenuApp.ALTA) {
                                mensaje_error = getString(R.string.alta_error);
                            } else if (opcion == MenuApp.ACTUALIZAR) {
                                mensaje_error = getString(R.string.actualizar_error);
                            }
                            Toast.makeText(getApplicationContext(), mensaje_error, Toast.LENGTH_LONG).show();
                        } else {
                            String mensaje_exito = "";
                            if (opcion == MenuApp.ALTA) {
                                mensaje_exito = getString(R.string.alta_ok);
                            } else if (opcion == MenuApp.ACTUALIZAR) {
                                mensaje_exito = getString(R.string.actulizar_ok);
                            }
                            Toast.makeText(getApplicationContext(), mensaje_exito, Toast.LENGTH_LONG).show();
                        }
                        volverMenu();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), getString(R.string.error_Volley_API), Toast.LENGTH_LONG).show();
                    }
                }
        );
        queue.add(jsonobj);

        /*if (respuesta.getError()) {
                            Toast.makeText(getApplicationContext(), getString(R.string.error_API) + " " + respuesta.getError_Mensaje(), Toast.LENGTH_LONG).show();
                        } else {
                            editor.putBoolean("logeado", respuesta.getCorrect_Password());

                            editor.commit();

                            if (preferences.getBoolean("logeado", false)) {
                                startActivity(new Intent(getApplicationContext(), MenuApp.class));
                            } else {
                                Toast.makeText(getApplicationContext(), getText(R.string.no_login), Toast.LENGTH_SHORT).show();
                            }
                        }*/
    }

    private void addListeners() {
        btn_ingresar.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                login();
            }
        });

        sp_Tipo.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) {
                String tipo = sp_Tipo.getSelectedItem().toString();
                if (tipo.equals("Alumno")) {
                    et_Boleta.setHint("Ingrese su boleta");
                } else if (tipo.equals("PAAE")) {
                    et_Boleta.setHint("Ingrese su número de trabajador");
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> parentView) {
                // your code here
            }
        });
    }

    private void enlazarVistas() {
        sp_Tipo = findViewById(R.id.spinner);
        et_Boleta = findViewById(R.id.editText_Boleta);
        btn_ingresar = findViewById(R.id.button_login);
    }

    private void getToken() {
        FirebaseMessaging.getInstance().getToken()
                .addOnCompleteListener(new OnCompleteListener<String>() {
                    @Override
                    public void onComplete(@NonNull Task<String> task) {
                        if (!task.isSuccessful()) {
                            return;
                        }

                        token = task.getResult();
                    }
                });
    }
}