using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using HtmlAgilityPack;
using System.Web;
using System.IO;
using MySql.Data.MySqlClient;
using System.Diagnostics;
using System.ComponentModel;
using System.Net;
using System.Threading;

namespace Examensarbete
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {

        List<string> rubriker = new List<string>();
        List<string> imgLinks = new List<string>();
        List<string> texts = new List<string>();

        string connectionString = @"Data Source=localhost;Initial Catalog=test;User ID=root;Password=";
        MySqlConnection cnn;

        public MainWindow()
        {
            InitializeComponent();

            //Initialize connection to database
            cnn = new MySqlConnection(connectionString);
            cnn.Open();

        }

        int i = 0;

        private void Button_Click(object sender, RoutedEventArgs e)
        {


            //lägger in rubrik och länk som item i tabletest i test-databasen

            while (i < 10)
            {

                string inputHeader = $"\"{rubriker[i]}.\"";
                string arg = string.Format(@"C:\Users\HP\Documents\Python\Projekt\textProcessing.py {0}", inputHeader);

                Process p = new Process();
                p.StartInfo.FileName = "Python.exe";
                p.StartInfo.Arguments = arg;
                p.StartInfo.UseShellExecute = false;

                p.StartInfo.CreateNoWindow = true;
                p.StartInfo.RedirectStandardInput = true;
                p.StartInfo.RedirectStandardOutput = true;
                p.StartInfo.RedirectStandardError = true;
                p.Start();

                string output = p.StandardOutput.ReadToEnd();

                //SQL insert fungerar ej med apostrof, för att fixa lägg till en ytterliggare apostrof efter varje så att det blir dubbelt
                StringBuilder filteredOutput = new StringBuilder(output);
                filteredOutput.Replace("'", "''");
                filteredOutput.Replace("\"", "''");
                filteredOutput.Replace("#", " ");
                filteredOutput.Replace("@", " ");
                filteredOutput.Replace("&", "and");

                StringBuilder filteredHeading = new StringBuilder(rubriker[i]);
                filteredHeading.Replace("'", "''");


                string query = $"INSERT INTO tabletest(heading, imagelink, text) VALUES ('{filteredHeading}', '{imgLinks[i]}', '{filteredOutput}');";
                MySqlCommand comm = cnn.CreateCommand();
                comm.CommandText = query;
                comm.ExecuteNonQuery();

                i++;

                string logmsg = $"Added an article!\n";
                log.Inlines.Add(new Run(logmsg) { Foreground = Brushes.Green });

            }

        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {
           
            string query = $"DELETE FROM tabletest;";
            MySqlCommand comm = cnn.CreateCommand();
            comm.CommandText = query;
            comm.ExecuteNonQuery();

            string query2 = $"ALTER TABLE tabletest AUTO_INCREMENT = 1;";
            MySqlCommand comm2 = cnn.CreateCommand();
            comm2.CommandText = query2;
            comm2.ExecuteNonQuery();

            string logmsg = "Cleared Database\n";
            log.Inlines.Add(new Run(logmsg) { Foreground = Brushes.Red });
        }

        private void Button_Click_2(object sender, RoutedEventArgs e)
        {


            int headerCount = 0;
            int failures = 0;
           
            List<string> searchTermList = new List<string>();
            string allSearchTerms = "SÖKTERMER\n---------------------------";
         
            string headerSite = @"https://newslookup.com/world/";
            HtmlWeb web = new HtmlWeb();
            var htmlDoc = web.Load(headerSite);

            foreach (HtmlNode node in htmlDoc.DocumentNode.SelectNodes("//a[@class='link']"))
            {
                             
                 StringBuilder sb = new StringBuilder(node.InnerText);
                 sb.Replace("?", " ");
                 sb.Replace(">", " ");
                 sb.Replace(":", " ");

                 
                 string searchTerm = sb.ToString();

                 searchTermList.Add(searchTerm);
                 allSearchTerms += "\n" + headerCount + ": " + searchTerm;
                      
            }



            List<string> list = new List<string>();

            foreach (string searchTerm in searchTermList)
            {
                string imgsite = $@"https://www.picsearch.com/index.cgi?q={searchTerm}";

                HtmlWeb web2 = new HtmlWeb();
                var htmlDoc2 = web2.Load(imgsite);

                HtmlNode imageNode = htmlDoc2.DocumentNode.SelectSingleNode(".//img");
                try
                {
                    imgLinks.Add(imageNode.GetAttributeValue("src", "nothing"));
                    StringBuilder sb = new StringBuilder(searchTerm);
                    sb.Replace("+", " ");

                    rubriker.Add(sb.ToString());
                    headerCount++;
                }

                catch(Exception exception)
                {


                    /*MessageBox.Show(imgLinks.Count.ToString());
                    MessageBox.Show(allSearchTerms);
                    MessageBox.Show(exception.ToString());*/


                    failures++;

                }
               


            }

         

            string logmsg = $"Added {headerCount} headings and images!\n";
            log.Inlines.Add(new Run(logmsg) { Foreground = Brushes.Green });
            string logmsg2 = $"{failures} failures!\n";
            log.Inlines.Add(new Run(logmsg2) { Foreground = Brushes.Red });


        }



        private void Button_Click_3(object sender, RoutedEventArgs e)
        {

            string exampleHeader = "\" Todays headlines: \"";
            string arg = string.Format(@"C:\Users\HP\Documents\Python\Projekt\textProcessing.py {0}", exampleHeader);

            Process p = new Process();
            p.StartInfo.FileName = "Python.exe";
            p.StartInfo.Arguments = arg;
            p.StartInfo.UseShellExecute = false;
           
            p.StartInfo.CreateNoWindow = true;
            p.StartInfo.RedirectStandardInput = true;
            p.StartInfo.RedirectStandardOutput = true;
            p.StartInfo.RedirectStandardError = true;
           
            try
            {
                p.Start();
            }

            catch(Win32Exception w)
            {
                MessageBox.Show(w.ToString());
            }
            
            string output = p.StandardOutput.ReadToEnd();
            MessageBox.Show(output);

        }

        private void Button_Click_4(object sender, RoutedEventArgs e)
        {
            Environment.Exit(0);
        }

        private void Window_MouseDown(object sender, MouseButtonEventArgs e)
        {
            if (e.ChangedButton == MouseButton.Left)
                this.DragMove();
        }

        private void Button_Click_5(object sender, RoutedEventArgs e)
        {
            WindowState = WindowState.Minimized;
        }
    }
}
