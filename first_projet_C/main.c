#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <windows.h>
#include <conio.h>
#include <unistd.h>
//réaliser par ZAKARIA ABOULKACEM , IMAD ASKOUR , SALAH EDDINE EL BOUAYADI .
void gotoxy(int x, int y) {
    COORD coord;
    coord.X = x;
    coord.Y = y;
    SetConsoleCursorPosition(GetStdHandle(STD_OUTPUT_HANDLE), coord);
}

void Color(int couleurDuTexte, int couleurDeFond) {
    HANDLE H = GetStdHandle(STD_OUTPUT_HANDLE);
    SetConsoleTextAttribute(H, couleurDeFond * 16 + couleurDuTexte);
}

void distincts(int *T1, int *T2) {
    int i, j, d = 0;
    char P1[] = "Entrez 5 chiffres distincts entre 0 et 9 (avec un 'espace' entre les chiffres) : ";
    char P2[] = "Vous avez ecrit un chiffre >9.\n";
    char P3[] = "Vous avez ecrit un chiffre plusieurs fois.\n";

    do {
        gotoxy(20, 5);
        Color(15, 0);
        for (j = 0; P1[j] != '\0'; j++) {
            printf("%c", P1[j]);
            Sleep(20);
        }
        gotoxy(40, 10);
        printf("ici =>     ");
        for (i = 0; i < 5; i++) {
            scanf("%d", &T1[i]);
        }

        d = 0;
        system("cls");
        printf("\n\n\n");
        for (i = 0; i < 5; i++) {
            if (*(T1 + i) > 9) {
                d = 1;
                Color(4, 0);
                printf("%s", P2);
                break;
            }
            system("cls");
            printf("\n\n\n");
            for (j = i + 1; j < 5; j++) {
                if (*(T1 + i) == *(T1 + j)) {
                    d = 1;
                    Color(4, 0);
                    printf("%s", P3);
                    break;
                }
            }
            if (d == 1) {
                break;
            }
        }
    } while (d == 1);
}
int fonction(int *T1, int *T2,char nom2[] ) {
    int i, j, k, s = 0, t = 1, jokerUtilise = 0;
    int b = 0, m = 0;
    char joker, o;
    char S1[] = "tu peux choisir l'ordre du chiffre que vous voulez afficher : ";
    char S2[] = "\n\n\n\t\tBravo, vous avez trouve les cinq chiffres!\n";
    gotoxy(20, 5);

    for (i = 1; i < 21; i++) {
        system("color 70");
        printf("\n\n\n\t\t tentative N %d pour %s    ", t, nom2);

        for (k = 0; k < 5; k++) {
            scanf("%d", &(*(T2 + k)));
        }

        b = 0;
        m = 0;

        for (k = 0; k < 5; k++) {
            if (*(T2 + k) == *(T1 + k)) {
                b++;
            } else {
                for (j = 0; j < 5; j++) {
                    if (*(T2 + k) == *(T1 + j)) {
                        m++;
                        break;
                    }
                }
            }
        }

        printf("%d bien place\n", b);
        printf("%d Mal place\n", m);
        t++;
        s++;
        if (b == 5) {
                system("color 20");
            for (j = 0; S2[j] != '\0'; j++) {
                printf("%c", S2[j]);
                Sleep(50);
            }
            printf("les chiffres sont :");
            for(i=0;i<5;i++)
                printf("\t%d",T1[i]);
            printf("\n\tLe score est %d\n", s);
            SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE), FOREGROUND_GREEN | FOREGROUND_BLUE | FOREGROUND_RED);
            break;
        }

        if (i >= 10 && jokerUtilise == 0 && i<18 ) {
            printf("Si vous voulez un joker, tapez sur 'J' (attention, cette option elimine trois tentatives). Sinon, appuyez sur une lettre : ");
            scanf(" %c", &joker);

            if (joker == 'j' || joker == 'J') {
                jokerUtilise = 1;
                for (j = 0; S1[j] != '\0'; j++) {
                    printf("%c", S1[j]);
                    Sleep(50);
                }
                scanf("%d", &o);
                printf("                     ");

                for (j = 0; j < o - 1; j++)
                    printf("\t*");

                printf("\t %d", *(T1 + o - 1));

                for (j = o; j < 5; j++)
                    printf("\t*");
                i = i + 3;
            }
            else{
                continue;
            }
        }
    }

    if (i == 21) {
        printf("Vous avez termine toutes les tentatives.\n");
        system("color 40");
    }

    return s;
}


int main() {
    char nom1[15], nom2[15], niveau,reponse;
    int T1[5], T2[5], joker,d,repeter;
    int s = 0, i, j, k, o;
    char Y0[] = "Methode : \n1.Le joueur 1 propose un code (entree au clavier de 5 chiffres).\n2.Le joueur 2 propose un autre code de 5 chiffres.\n3.Le programme indique le nombre des chiffres bien placees et mal placees.\n4.Si le code est trouve le programme s'arrete.\n5.Si le nombre max d'essais est atteint (20 tentatives), le jeu s'arrete avec affichage du code.";
    char Y2[] = "Joueur 1,tu peux  entrer votre nom : ";
    char Y4[] = "joueur 2, c'est votre tour de saisir le nom   :";
    char Y5[] = "Entrez 5 chiffres (vous pouvez repeter un chiffre plusieurs fois) : \nRemarque : Il vaut mieux avoir un espace entre les cinq chiffres";
    Color(12, 0);
    printf("\n\n\n\n\n");
    char Y6[] ="BBBBB     III     EEEEE    NN   NN    V   V    EEEEE    NN   NN    U   U  EEEEE\n";
    char Y7[] ="B   B      I      E        N N  NN    V   V    E        N N  NN    U   U  E    \n";
    char Y8[] ="BBBBB      I      EEEE     N  N NN    V   V    EEEE     N  N NN    U   U  EEEE \n";
    char Y9[] ="B   B      I      E        N   N N     V V     E        N   N N    U   U  E    \n";
    char Y88[]="BBBBB     III     EEEEE    N    NN      V      EEEEE    N    NN     UUU   EEEEE\n";
    for (i = 0; Y6[i] != '\0'; i++) {
        printf("%c", Y6[i]);
        Sleep(10);
         }
          for (i = 0; Y7[i] != '\0'; i++) {
        printf("%c", Y7[i]);
        Sleep(10);
         }
          for (i = 0; Y8[i] != '\0'; i++) {
        printf("%c", Y8[i]);
        Sleep(10);
         }
          for (i = 0; Y9[i] != '\0'; i++) {
        printf("%c", Y9[i]);
        Sleep(10);
         }
          for (i = 0; Y88[i] != '\0'; i++) {
            printf("%c", Y88[i]);
             Sleep(10);
         }
      printf("\t\t\t_ _ _ _ _ _ _ _ _ _ __ _ \n");
    printf("  \t\t\t|     |     |     |     |\n");
    printf("  \t\t\t|  D  |  A  |  N  |  S  |\n");
    printf("  \t\t\t|||||||||||||||||||||||||\n");

    printf("  \t _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _  _ _ _ _ _ _ _\n");
    printf("  \t|     |     |     |     |     |     |     |     |      |      |\n");
    printf("  \t|  M  |  A  |  S  |  T  |  E  |  R  |  M  |  I  |  N   |  D   |\n");
    printf("  \t|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||\n");
    gotoxy(20, 5);
    Sleep(1000);
    gotoxy(10, 20);
    SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE), FOREGROUND_GREEN | FOREGROUND_BLUE | FOREGROUND_RED);
    for (i = 0; Y0[i] != '\0'; i++) {
        printf("%c", Y0[i]);
        Sleep(20);
    }
    Color(14,0);
    printf("\n appuyer sur <<entrer>> pour continuer");
    getchar();

do{
    Color(15,0);
    system("cls");
    gotoxy(20, 5);
    for (i = 0; Y2[i] != '\0'; i++) {
        printf("%c", Y2[i]);
        Sleep(100);
    }
    scanf("%s", nom1);

    system("cls");
    gotoxy(20, 5);

    printf("bonjour %s .\n  veuillez choisir le niveau (1 = debutant / 2 = expert) : ", nom1);
    scanf(" %c", &niveau);
    system("cls");
    gotoxy(20, 5);
    printf("Appuyez sur <");
    Color(14,0);
    printf("Entrer");
    Color(15,0);
    printf("> pour continuer...\n");
    getchar();
    getchar();
    system("cls");

   switch (niveau) {
            case '1':
                distincts(T1, T2);
                system("cls");
                gotoxy(20, 5);
                for (i = 0; Y4[i] != '\0'; i++) {
                    printf("%c", Y4[i]);
                    Sleep(50);
                }
                scanf("%s", nom2);
                system("cls");

                s += fonction(T1, T2, nom2);
                break;

            case '2':
                do {
                    gotoxy(20, 5);
                    for (i = 0; Y5[i] != '\0'; i++) {
                        printf("%c", Y5[i]);
                        Sleep(20);
                    }gotoxy(50,10);
                    printf("ici=>     ");
                    for (i = 0; i < 5; i++) {
                        scanf("%d", &(*(T1 + i)));
                    }
                    d = 0;
                    for (i = 0; i < 5; i++) {
                        if (T1[i] > 9) {
                            d = 1;
                            system("cls");
                            Color(4,0);
                            printf("\n\nvous avez ecris un chiffre >9.\n\n");
                            Color(15,0);
                            break;
                        }
                    }
                } while (d == 1);
                system("cls");
                gotoxy(20, 5);
                for (i = 0; Y4[i] != '\0'; i++) {
                    printf("%c", Y4[i]);
                    Sleep(20);
                }
                scanf("%s", nom2);
                system("cls");

                s += fonction(T1, T2, nom2);
                break;

            default:
                printf("Ce niveau n'existe pas.\n");
                break;
        }
 printf("Voulez-vous répéter le jeu ? (A pour oui, autre caractère pour non): ");
        scanf(" %c", &reponse);

        if (reponse == 'A' || reponse == 'a') {
            repeter = 1;
        } else {
            repeter = 0;
        }

    } while (repeter == 1);
    FILE *fichier = fopen("projet1.doc", "a");
    if (fichier == NULL) {
        gotoxy(20, 5);
        printf("Erreur lors de l'ouverture du fichier.\n");
    } else {
        gotoxy(20, 5);
        fprintf(fichier, "\nLe nom du joueur 2 est : %s, son score est %d", nom2, s);
        fclose(fichier);
    }
    return 0;
}
