package com.example.decode.KECircle;

import android.app.ListActivity;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;

/**
 * Created by Decode on 27/05/2016.
 */
public class HomeActivity extends ListActivity
{

    String[] activities = {"Chat","Forum","Boost your mind",
            "Become a Listener","Log Out"};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        Intent intent = getIntent();

        Bundle intentBundle = intent.getExtras();

        final String loggedUser = intentBundle.getString("USERNAME");
        setListAdapter(new ArrayAdapter<String>(this, R.layout.list_item,activities));

        ListView listView = getListView();
        listView.setBackgroundColor(Color.parseColor("#08253c"));
        listView.setTextFilterEnabled(true);
        final Context mContext = this;
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> a, View v, int position, long id) {

                if (position == 0) {
                    mContext.startActivity(new Intent(HomeActivity.this, ChatActivity.class));
                } else if (position == 1) {
                    Intent intent1= new Intent(HomeActivity.this, ForumActivity.class);
                    intent1.putExtra("USERNAME", loggedUser);
                    mContext.startActivity(intent1);
                }
            }
        });
    }
}