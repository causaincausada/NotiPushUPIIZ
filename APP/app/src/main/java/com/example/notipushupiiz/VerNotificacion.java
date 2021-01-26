package com.example.notipushupiiz;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class VerNotificacion extends AppCompatActivity {
    TextView tv_grupo;
    TextView tv_titulo;
    TextView tv_fecha;
    TextView tv_des;
    Button btn_regresar;

    String grupo;
    String titulo;
    String fecha;
    String des;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ver_notificacion);

        setTitle("Notificacion");
        getData();
        enlazarVistas();
        addListeners();
        setData();
    }

    private void setData(){
        tv_grupo.setText(grupo);
        tv_titulo.setText(titulo);
        tv_fecha.setText(fecha);
        tv_des.setText(des);
    }

    private void addListeners(){
        btn_regresar.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                finish();
            }
        });
    }

    private void  enlazarVistas(){
        tv_grupo = findViewById(R.id.textView_ver_grupo);
        tv_titulo = findViewById(R.id.textView_ver_titulo);
        tv_fecha = findViewById(R.id.textView_ver_fecha);
        tv_des = findViewById(R.id.textView_ver_descripcion);
        btn_regresar = findViewById(R.id.button_ver_regresar);
    }

    private void getData(){
        Bundle datos = this.getIntent().getExtras();
            grupo = datos.getString("grupo");
            titulo = datos.getString("titulo");
            fecha = datos.getString("fecha");
            des = datos.getString("descripcion");
    }
}