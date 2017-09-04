#include <stdbool.h>
#include <stdio.h>
#include <ctype.h>
#include <stdlib.h>

#include "dictionary.h" 

extern int wordCount;

extern node* root; 


bool check(const char* word)
{
    int index = 0;
    int nodeIndex;
    struct node* cursor = root;
   
    while (word[index] != '\0')
    {
      
        if (isalpha(word[index]))
        {   
          
            if(isupper(word[index]))
            {
                nodeIndex = word[index] - 'A';
            }
           
            else
            {
                nodeIndex = word[index] - 'a';
            }
        }
    
        else
        {
            nodeIndex = 26;
        }
       
        if (cursor->node[nodeIndex] == NULL)
        {
            return false;
        }
       
        else
        {
            
            cursor = cursor->node[nodeIndex];
        }  
        index++;
    }
   
    if (cursor->isWord == true)
    {
        return true;
    }
    return false;
}


bool load(const char* dictionary)
{
    // open dictionary file
    FILE* fp = fopen(dictionary, "r");
    
    char word[LENGTH + 1];
    int index = 0;
    char charWord;
    wordCount = 0;
    
  
    root = (struct node*) malloc(sizeof(node));
    
    
    for (int c = fgetc(fp); c != EOF; c = fgetc(fp))
    {
       
        if (c == '\n')
        {
            word[index] = c;

            wordCount++;
            struct node* cursor = root;
            for (int i = 0; i <= index; i++)
            {
                charWord = word[i];
               
                if (isalpha(charWord))
                {
                    
                    if (cursor->node[charWord - 'a'] == NULL)
                    {
                        cursor->node[charWord - 'a'] = (struct node*) malloc(sizeof(node));
                    }
                    cursor = cursor->node[charWord - 'a'];
                }
               
                else if (charWord == '\'')
                {
                    
                    if (cursor->node[26] == NULL)
                    {
                        cursor->node[26] = (struct node*) malloc(sizeof(node));
                    }
                    cursor = cursor->node[26];
                }
                
                else if (charWord == '\n')
                {
                    cursor->isWord = true;
                }
            }
           
            index = 0;
        }
        else
        {
            word[index] = c;
            index++;
        }
    }
    fclose(fp);
    return true;
}

unsigned int size(void)
{
    return wordCount;
}


bool unload(void)
{
    if (freeNode(root))
    {
        return true;
    }
    return false;
}


bool freeNode(struct node* node)
{
   
    for (int i = 0; i < 27; i++)
    {
        
        if (node->node[i] != NULL)
        {
            freeNode(node->node[i]);
        }
    }
    
    free(node);

    return true;
}