package com.example.decode.KECircle;

/**
 * Created by Decode on 22/05/2016.
 */
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;



public class LoginActivity extends ActionBarActivity {

    @Override

    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_login);
        Intent intent = getIntent();

        Bundle intentBundle = intent.getExtras();

        String loggedUser = intentBundle.getString("USERNAME");

        String message = intentBundle.getString("MESSAGE");

        final String username=loggedUser;


        loggedUser = capitalizeFirstCharacter(loggedUser);


        TextView loginUsername = (TextView) findViewById(R.id.login_user);

        TextView successMessage = (TextView) findViewById(R.id.message);

        loginUsername.setText(loggedUser);

        successMessage.setText(message);

        Button click_button = (Button)findViewById(R.id.Beginbutton);
        click_button.setOnClickListener(
                new Button.OnClickListener()
                {
                    public void onClick(View v)
                    {
                        Intent intent1= new Intent(LoginActivity.this,HomeActivity.class);
                        intent1.putExtra("USERNAME", username);
                        startActivity(intent1);
                    }
                }


        );




}




    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.

        getMenuInflater().inflate(R.menu.menu_login, menu);

        return true;

    }

    @Override

    public boolean onOptionsItemSelected(MenuItem item) {

// Handle action bar item clicks here. The action bar will

// automatically handle clicks on the Home/Up button, so long

// as you specify a parent activity in AndroidManifest.xml.

        int id = item.getItemId();

//noinspection SimplifiableIfStatement

        if (id == R.id.action_settings) {

            return true;

        }

        return super.onOptionsItemSelected(item);

    }

    private String capitalizeFirstCharacter(String textInput){

        String input = textInput.toLowerCase();

        String output = input.substring(0, 1).toUpperCase() + input.substring(1);

        return output;

    }

}