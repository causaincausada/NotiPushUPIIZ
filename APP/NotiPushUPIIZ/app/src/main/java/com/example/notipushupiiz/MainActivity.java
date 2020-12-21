package com.example.notipushupiiz;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;

import com.example.notipushupiiz.ui.home.HomeFragment;

public class MainActivity extends AppCompatActivity {
    boolean iniciado=true;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        if(!iniciado){
            Intent intent= new Intent(getApplicationContext(),LoginInicial.class);
            startActivity(intent);
        }else{
            Intent intent= new Intent(getApplicationContext(), drawer.class);
            startActivity(intent);
        }
    }
}