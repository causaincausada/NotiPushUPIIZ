package com.example.notipushupiiz;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.notipushupiiz.ui.MiAdaptador;
import com.google.android.material.navigation.NavigationView;
import com.google.gson.Gson;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import java.util.ArrayList;
import java.util.List;

import JSON_IN.GetNotis;
import JSON_IN.Grupo;
import JSON_IN.Notificacion;
import JSON_IN.NotisyGrups;

public class MenuApp extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener, AdapterView.OnItemClickListener{
    private final String nombre_archivo = "credenciales";
    String token;
    String data_nombre;
    String data_programa;
    String data_boleta;
    String data_tipo;
    String idUsuario;
    private ListView lv_noti;
    private NavigationView mNavigationView;
    private List<Notificacion> notificaciones;
    private List<Grupo> grupos;
    private ArrayList<NotisyGrups> notisyGrups;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_app);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        setTitle("Listado de Notificaciones");
        getData();
        enlazarVistas();
        addListeners();
        setItemsMenu();
        getNoti();
    }

    private void getNoti() {
        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        final String url = "http://10.0.2.2/NotiPushUPIIZ/WEB/php/getNoti_Usuario.php?idUsuario=" + idUsuario;
        System.out.println(url);

        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Gson json_respuesta = new Gson();
                        GetNotis respuesta = json_respuesta.fromJson(response, GetNotis.class);
                        if (respuesta.getCorrecto()) {
                            notificaciones = respuesta.getNotificaciones();
                            grupos = respuesta.getGrupos();
                            if (notificaciones.size() < 1) {
                                Toast.makeText(getApplicationContext(), "Usted no tiene notificaciones.", Toast.LENGTH_LONG).show();
                            }
                            mostrar_Lista();
                        } else {
                            Toast.makeText(getApplicationContext(), "Error al traer las notificaciones.", Toast.LENGTH_LONG).show();
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

    private void mostrar_Lista() {
        notisyGrups = new ArrayList<>();
        for (int i = 0; i < this.notificaciones.size(); i++){
            String grup = getGrup(notificaciones.get(i).getGrupo_idGrupo());
            Notificacion temp = notificaciones.get(i);
            notisyGrups.add(new NotisyGrups(temp.getIdNotificacion(), temp.getTitulo(), temp.getDescripcion(), temp.getFecha(), grup));
        }

        MiAdaptador miAdaptador = new MiAdaptador(getApplicationContext(), R.layout.noti_diseno, this.notisyGrups);
        lv_noti.setAdapter(miAdaptador);
    }

    private String getGrup(String id){
        for (int i=0; i<this.grupos.size(); i++){
            if(id.equals(grupos.get(i).getIdGrupo())) return grupos.get(i).getNombre();
        }
        return "";
    }

    private void setItemsMenu() {
        View headerView = mNavigationView.getHeaderView(0);
        TextView tV_menu_nombre = headerView.findViewById(R.id.textView_menu_nombre);
        TextView tV_menu_boleta = headerView.findViewById(R.id.textView_menu_boleta);
        TextView tV_menu_tipo = headerView.findViewById(R.id.textView_menu_tipo);
        TextView tV_menu_programa = headerView.findViewById(R.id.textView_menu_programa);

        tV_menu_nombre.setText(this.data_nombre);
        tV_menu_boleta.setText(this.data_boleta);
        tV_menu_tipo.setText(this.data_tipo);
        tV_menu_programa.setText(this.data_programa);
    }

    private void addListeners() {
        if (mNavigationView != null) {
            mNavigationView.setNavigationItemSelectedListener(this);
        }
        if (lv_noti != null) {
            lv_noti.setOnItemClickListener(this);
        }
    }

    private void enlazarVistas(){
        mNavigationView = findViewById(R.id.nav_view);
        lv_noti = findViewById(R.id.listado);
    }

    private void getData() {
        SharedPreferences preferences = getSharedPreferences(nombre_archivo, Context.MODE_PRIVATE);
        token = preferences.getString("token", "");
        data_nombre = preferences.getString("nombrecompleto", "");
        data_programa = preferences.getString("programa", "");
        data_boleta = preferences.getString("boleta", "");
        data_tipo = preferences.getString("tipo", "");
        idUsuario = preferences.getString("idUsuario", "");
    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Intent intent = new Intent(getApplicationContext(), VerNotificacion.class);
        intent.putExtra("grupo", notisyGrups.get(position).getGrupo());
        intent.putExtra("titulo", notisyGrups.get(position).getTitulo());
        intent.putExtra("fecha", notisyGrups.get(position).getFecha());
        intent.putExtra("descripcion", notisyGrups.get(position).getDescripcion());
        startActivity(intent);
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        int id = item.getItemId();
        DrawerLayout menuDrawer = findViewById(R.id.drawer_layout);
        menuDrawer.closeDrawer(GravityCompat.START);
        switch (id){
            case R.id.nav_home://Notis
                getNoti();
                break;

            case R.id.nav_gallery://Salir
                SharedPreferences preferences = getApplicationContext().getSharedPreferences(nombre_archivo, Context.MODE_PRIVATE);
                preferences.edit().clear().commit();
                finish();
                break;
        }
        return false;
    }

    @Override
    public void onBackPressed() {
        // super.onBackPressed();
        // Not calling **super**, disables back button in current screen.
    }

    @Override
    public void onStart() {
        SharedPreferences preferences = getSharedPreferences(nombre_archivo, Context.MODE_PRIVATE);//Nombre del archivo
        if (!preferences.getBoolean("logeado", false)) {
            startActivity(new Intent(getApplicationContext(), MainActivity.class));
        }
        super.onStart();
    }
}