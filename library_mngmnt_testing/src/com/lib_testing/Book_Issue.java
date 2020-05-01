package com.lib_testing;

import java.util.List;
import java.util.concurrent.TimeUnit;
import org.openqa.selenium.support.ui.Select;
/*import org.apache.bcel.generic.Select;*/
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.testng.Assert;
import org.testng.annotations.AfterMethod;
import org.testng.annotations.BeforeMethod;
import org.testng.annotations.Test;

public class Book_Issue {
	WebDriver driver;

	@BeforeMethod
	public void setUp() {
		System.setProperty("webdriver.chrome.driver", ".\\drivers\\chromedriver.exe");
		driver = new ChromeDriver();
		driver.manage().timeouts().pageLoadTimeout(50, TimeUnit.SECONDS);
		driver.manage().timeouts().implicitlyWait(20, TimeUnit.SECONDS);
		driver.manage().window().maximize();
	}

	@Test
	public void bookIsuueTest() {
		driver.get("http://localhost/Testing_library/project/librarian/adminlogin.php");
		driver.findElement(By.name("un")).sendKeys("admin");
		driver.findElement(By.name("pass")).sendKeys("admin");
		driver.findElement(By.name("sub")).click();
		driver.findElement(
				By.xpath("//div[@id='sidebar-menu']//ul[@class='nav side-menu']//a[@href='issue_books.php']")).click();
		sleep(3000);
		Select drop1 = new Select(driver.findElement(By.xpath("/html//select[@id='ee']")));
		drop1.selectByIndex(1);

		driver.findElement(By.xpath(
				"/html/body[@class='nav-md']//div[@role='main']//div[@class='row']//form[@name='f1']/button[@name='sub']"))
				.click();
		Select drop2 = new Select(
				driver.findElement(By.xpath("//div[@id='issuebox']/form[@name='sform']/select[@id='ee']")));
		drop2.selectByIndex(1);
		driver.findElement(By.xpath("//div[@id='issuebox']/form[@name='sform']/button[@name='sub2']")).click();

		String at = driver
				.findElement(By.xpath("//div[@id='issuebox']/div[@class='alert alert-success col-lg-6 col-lg-push-3']"))
				.getText();
		String et = "Book Issued successfully!!";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
			Assert.assertTrue(true);
		} else {
			System.out.println("Test UnSuccessful");
			Assert.assertTrue(false);
		}

		/* sleep(3000); */
	}

	@AfterMethod
	public void tearDown() {
		driver.quit();
	}

	private void sleep(long m) {
		try {
			Thread.sleep(m);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}
