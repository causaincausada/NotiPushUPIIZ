package com.example.notipushupiiz.ui;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.Canvas;
import android.graphics.drawable.Drawable;
import android.os.Build;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;

import android.widget.ImageView;
import android.widget.TextView;

import androidx.core.content.ContextCompat;
import androidx.core.graphics.drawable.DrawableCompat;

import com.example.notipushupiiz.R;

import java.util.List;


import JSON_IN.NotisyGrups;

public class MiAdaptador extends BaseAdapter {
    private final Context c;
    private final int diseno;
    private final List<NotisyGrups> notis;

    public MiAdaptador(Context c, int diseno, List<NotisyGrups> notis) {
        this.c = c;
        this.diseno = diseno;
        this.notis = notis;
    }

    @Override
    public int getCount() {
        return this.notis.size();
    }

    @Override
    public Object getItem(int position) {
        return this.notis.get(position);
    }

    @Override
    public long getItemId(int position) {
        return Long.parseLong(this.notis.get(position).getIdNotificacion(), 10);
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        View vDiseno = convertView;
        if (vDiseno == null) {
            LayoutInflater layoutInflater = LayoutInflater.from(this.c);
            vDiseno = layoutInflater.inflate(this.diseno, null);
        }
        TextView tv_grupo = vDiseno.findViewById(R.id.textView_dis_grupo);
        TextView tv_titulo = vDiseno.findViewById(R.id.textView_dis_titulo);
        TextView tv_fecha = vDiseno.findViewById(R.id.textView_dis_fecha);
        ImageView iv_logo = vDiseno.findViewById(R.id.imageView_notis);

        tv_grupo.setText(notis.get(position).getGrupo());
        tv_titulo.setText(notis.get(position).getTitulo());
        tv_fecha.setText(notis.get(position).getFecha());
        iv_logo.setImageBitmap(getBitmapFromVectorDrawable(c, R.drawable.ic_baseline_comment_24));

        return vDiseno;
    }

    public static Bitmap getBitmapFromVectorDrawable(Context context, int drawableId) {
        Drawable drawable = ContextCompat.getDrawable(context, drawableId);
        if (Build.VERSION.SDK_INT < Build.VERSION_CODES.LOLLIPOP) {
            drawable = (DrawableCompat.wrap(drawable)).mutate();
        }

        Bitmap bitmap = Bitmap.createBitmap(drawable.getIntrinsicWidth(),
                drawable.getIntrinsicHeight(), Bitmap.Config.ARGB_8888);
        Canvas canvas = new Canvas(bitmap);
        drawable.setBounds(0, 0, canvas.getWidth(), canvas.getHeight());
        drawable.draw(canvas);

        return bitmap;
    }
}
